<?php

namespace App\Http\Controllers;

use App\Chollo;
use App\TiendaChollo;
use App\CategoriaChollo;
use App\Comentario;
use App\TipoDescuento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class CholloController extends Controller
{

    public function __construct(){
        $this->middleware(['auth', 'verified'], ['except' => ['show', 'search','gratis','promociones','cupones','guardados','ultimos','populares']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $usuario = auth()->user();

        $chollos = Chollo::where('user_id', $userId)->paginate(5);

        return view('chollos.index')->with('chollos',$chollos)->with('usuario',$usuario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categorias = CategoriaChollo::all(['id','nombre']);
        $tiendas = TiendaChollo::all(['id','nombre']);
        $tipodescuentos = TipoDescuento::all(['id', 'nombre']);

        return view('chollos.crear')->with('categorias', $categorias)->with('tiendas', $tiendas)->with('tipodescuentos', $tipodescuentos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validacion 

        $rules = [
            'titulo'=>'required|min:5',
            'categoria'=> 'required',
            'tipodescuento'=> 'required',
            'tienda'=> 'required',
            'url'=> 'required|url',
            'cupon'=>'nullable',
            'producto'=>'nullable',
            'descripcion'=> 'required',
            'imagen' => 'required|image'
        ];   

            if ($request['tipodescuento'] == 1){
                $rules['precio_anterior'] = 'nullable|regex:/^\d+(\.\d{1,2})?$/';
                $rules['precio_actual'] = 'required|regex:/^\d+(\.\d{1,2})?$/';
            } elseif ($request['tipodescuento'] == 2){
                $rules['descuento'] = 'required|integer|between:0,100';
            } elseif ($request['tipodescuento'] == 3){
                $rules['gratis'] = 'required|integer|between:0,0';
            }
        
        

        $data = $request->validate($rules);


        //Obtener ruta imagen
        $ruta_imagen = $request['imagen']->store('upload-chollos','public');

        //Cambiar tamaño imagen
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(500, 500);

            $precio_anterior = null;
            $precio_actual = null;
            $descuento = null;

        if ($request['tipodescuento'] == 1){
            $precio_anterior = $data['precio_anterior'];
            $precio_actual = $data['precio_actual'];
        } elseif ($request['tipodescuento'] == 2){
            $descuento = $data['descuento'];
        } elseif ($request['tipodescuento'] == 3){
            $precio_actual = $data['gratis'];
        }

        $img->save();      

            //Guardar en BD
            auth()->user()->chollos()->create([
                'titulo'=>$data['titulo'],
            'descripcion'=>$data['descripcion'],
            'categoria_id'=>$data['categoria'],
            'producto'=>$data['producto'],
            'tipo_descuento_id'=>$data['tipodescuento'],
            'tienda_id'=>$data['tienda'],
            'imagen'=>$ruta_imagen,
            'precio_anterior'=>$precio_anterior,
            'precio_actual'=>$precio_actual,
            'descuento'=>$descuento,
            'url'=>$data['url'],
            'cupon'=>$data['cupon'],
            'activo'=>true,
            'moderado'=>false
            ]);

        return redirect()->action('CholloController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chollo  $chollo
     * @return \Illuminate\Http\Response
     */
    public function show(Chollo $chollo)
    {
        $comentarios = Comentario::where('chollo_id', $chollo->id)->whereNull('parent_id')->paginate(4);

        $like = ( auth()->user() ) ? auth()->user()->likes->contains($chollo->id) : false;

        $likes = $chollo->likes->count();

        $follow = ( auth()->user() ) ? auth()->user()->follow->contains($chollo->id) : false;

        $ultimoschollos = Chollo::latest()->where('moderado', true)->limit(3)->get();

        $masBajo = Chollo::where('producto', 'like', '%' . $chollo->producto . '%')->where('moderado', true)->orderBy('precio_actual', 'asc')->take(2)->get();

        $maspopulares = Chollo::where('moderado', true)->withCount('likes')->orderBy('likes_count', 'desc')->take(3)->get();

        $urlActual = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        return view('chollos.ver')->with('chollo', $chollo)->with('comentarios', $comentarios)->with('like', $like)->with('likes', $likes)->with('follow', $follow)->with('ultimos', $ultimoschollos)->with('populares', $maspopulares)->with('urlActual', $urlActual)->with('masBajo', $masBajo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chollo  $chollo
     * @return \Illuminate\Http\Response
     */
    public function edit(Chollo $chollo)
    {
        $this->authorize('view',$chollo);

        $categorias = CategoriaChollo::all(['id','nombre']);
        $tiendas = TiendaChollo::all(['id','nombre']);
        $tipodescuentos = TipoDescuento::all(['id','nombre']);

        return view('chollos.editar')->with('categorias', $categorias)
        ->with('tiendas', $tiendas)->with('chollo', $chollo)->with('tipodescuentos', $tipodescuentos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chollo  $chollo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chollo $chollo)
    {

        $this->authorize('update',$chollo);

        //Validacion 

        $rules = [
            'titulo'=>'required|min:5',
            'categoria'=> 'required',
            'tipodescuento'=> 'required',
            'tienda'=> 'required',
            'url'=> 'required|url',
            'cupon'=>'nullable',
            'descripcion'=> 'required',
        ];   

            if ($request['tipodescuento'] == 1){
                $rules['precio_anterior'] = 'nullable|regex:/^\d+(\.\d{1,2})?$/';
                $rules['precio_actual'] = 'required|regex:/^\d+(\.\d{1,2})?$/';
            } elseif ($request['tipodescuento'] == 2){
                $rules['descuento'] = 'required|integer|between:0,100';
            } elseif ($request['tipodescuento'] == 3){
                $rules['gratis'] = 'required|integer|between:0,0';
            }
        
        

        $data = $request->validate($rules);

        $precio_anterior = null;
            $precio_actual = null;
            $descuento = null;

        if ($request['tipodescuento'] == 1){
            $precio_anterior = $data['precio_anterior'];
            $precio_actual = $data['precio_actual'];
            $descuento = null;
        } elseif ($request['tipodescuento'] == 2){
            $descuento = $data['descuento'];
            $precio_anterior = null;
            $precio_actual = null;
        } elseif ($request['tipodescuento'] == 3){
            $precio_actual = $data['gratis'];
            $descuento = null;
            $precio_anterior = null;
        }

        //Asignar valores
        $chollo->titulo = $data['titulo'];
        $chollo->descripcion = $data['descripcion'];
        $chollo->categoria_id = $data['categoria'];
        $chollo->tipo_descuento_id = $data['tipodescuento'];
        $chollo->tienda_id = $data['tienda'];
        $chollo->url = $data['url'];
        $chollo->descuento = $descuento;
        $chollo->precio_anterior = $precio_anterior;
        $chollo->precio_actual = $precio_actual;
        $chollo->cupon = $data['cupon'];
        
        if (request('imagen')){
            $ruta_imagen = $request['imagen']->store('upload-chollos','public');
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(500, 500);
            $img->save();
            $chollo->imagen = $ruta_imagen;
        }

        $chollo->save();

        return redirect()->action('CholloController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chollo  $chollo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chollo $chollo)
    {

        $this->authorize('delete', $chollo);

        $chollo->delete();

        return redirect()->action('CholloController@index');
    }

    // Cambiar estado del chollo
    public function estado(Request $request, Chollo $chollo)
    {
        $chollo->activo = $request->estado;

        $chollo->save();
    }

    public function search(Request $request)
    {
        $busqueda = $request->get('buscar');

        $chollos = Chollo::where('titulo', 'like', '%' . $busqueda . '%')->where('moderado', true)->paginate(12);
        $chollos->appends(['buscar' => $busqueda]);

        return view('buscar.ver')->with('chollos', $chollos)->with('busqueda', $busqueda);
    }

    public function gratis()
    {
        $chollos = Chollo::where('tipo_descuento_id', 3)->paginate(16);

        return view('chollos.gratis')->with('chollos',$chollos);
    }

    public function promociones()
    {
        $chollos = Chollo::where('tipo_descuento_id', 2)->paginate(16);

        return view('chollos.promociones')->with('chollos',$chollos);
    }

    public function cupones()
    {
        $chollos = Chollo::whereNotNull('cupon')->paginate(16);

        return view('chollos.cupones')->with('chollos',$chollos);
    }

    public function guardados()
    {
        $usuario = auth()->user();
        
        return view('chollos.guardados')->with('usuario',$usuario);
    }

    public function ultimos()
    {

        $chollos = Chollo::latest()->where('moderado', true)->paginate(16);

        return view('chollos.ultimos')->with('chollos',$chollos);
    }

    public function populares()
    {
        $chollos = Chollo::where('moderado', true)->withCount('likes')->orderBy('likes_count', 'desc')->paginate(16);

        return view('chollos.populares')->with('chollos',$chollos);
    }
}
