<?php

namespace App\Http\Controllers;

use App\Chollo;
use App\Perfil;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'verified'], ['except' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        $chollos = Chollo::where('moderado', true)->where('user_id', $perfil->user_id)->paginate(6);

        return view('perfiles.ver')->with('perfil', $perfil)->with('chollos', $chollos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        $this->authorize('view', $perfil);

        return view('perfiles.editar')->with('perfil', $perfil);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {

        $this->authorize('update', $perfil);

        $data = request()->validate([
            'nombre' => 'required',
            'descripcion' => '',
            'web' => 'url|nullable',
        ]);

        if (request('imagen')){
            $ruta_imagen = $request['imagen']->store('upload-perfiles','public');
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(500, 500);
            $img->save();
        }

        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

        unset($data['nombre']);

        auth()->user()->perfil->descripcion =  $data['descripcion'];
        if($request['imagen']){
            auth()->user()->perfil->imagen =  $ruta_imagen;
        }      
        auth()->user()->perfil->web =  $data['web'];

        auth()->user()->perfil->save();

        //auth()->user()->perfil()->update( array_merge(
           // $data['descripcion'],
           // $array_imagen ?? [],
       // ));

        return redirect()->action('PerfilController@show', auth()->user()->perfil);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
