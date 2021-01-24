<?php

namespace App\Http\Controllers;

use App\Chollo;
use App\TiendaChollo;
use App\TipoDescuento;
use App\CategoriaChollo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class AdminCholloController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chollos = Chollo::paginate(10);

        $pendientes = Chollo::where('moderado', false)->count();

        return view('admin.chollos.index')->with('chollos',$chollos)->with('pendientes',$pendientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        $categorias = CategoriaChollo::all(['id','nombre']);
        $tiendas = TiendaChollo::all(['id','nombre']);
        $tipodescuentos = TipoDescuento::all(['id', 'nombre']);

        return view('admin.chollos.crear')->with('categorias', $categorias)->with('tiendas', $tiendas)->with('tipodescuentos', $tipodescuentos);
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

        return redirect()->action('AdminCholloController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chollo  $chollo
     * @return \Illuminate\Http\Response
     */
    public function show(Chollo $chollo)
    {

        return view('chollos.ver')->with('chollo', $chollo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chollo  $chollo
     * @return \Illuminate\Http\Response
     */
    public function edit(Chollo $chollo)
    {
        $categorias = CategoriaChollo::all(['id','nombre']);
        $tiendas = TiendaChollo::all(['id','nombre']);
        $tipodescuentos = TipoDescuento::all(['id','nombre']);

        return view('admin.chollos.editar')->with('categorias', $categorias)->with('tiendas', $tiendas)->with('chollo', $chollo)->with('tipodescuentos', $tipodescuentos);
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
        $chollo->producto = $data['producto'];
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

        return redirect()->action('AdminCholloController@index');
    }



    public function destroy(Chollo $chollo)
    {
        $chollo->delete();
     
        return redirect()->action('AdminCholloController@index');
    }

    // Cambiar estado del chollo
    public function estado(Request $request, Chollo $chollo)
    {
        $chollo->activo = $request->estado;

        $chollo->save();
    }

    // Cambiar estado de moderación

    public function moderado(Request $request, Chollo $chollo)
    {
        $chollo->moderado = $request->moderado;

        $chollo->save();
    }

    public function search(Request $request)
    {
        $busqueda = $request->get('buscar');

        $chollos = Chollo::where('titulo', 'like', '%' . $busqueda . '%')->paginate(10);
        $chollos->appends(['buscar' => $busqueda]);

        return view('admin.chollos.index')->with('chollos', $chollos)->with('busqueda', $busqueda);
    }

    public function moderar()
    {      
        $chollos = Chollo::where('moderado', false)->paginate(10);

        return view('admin.chollos.moderar')->with('chollos',$chollos);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chollo  $chollo
     * @return \Illuminate\Http\Response
     */
}
