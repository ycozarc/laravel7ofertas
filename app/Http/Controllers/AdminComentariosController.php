<?php

namespace App\Http\Controllers;

use App\Comentario;
use Illuminate\Http\Request;

class AdminComentariosController extends Controller
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
        $comentarios = Comentario::paginate(10);
        
        return view('admin.comentarios.index')->with('comentarios', $comentarios);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comentario $comentario)
    {
        return view('admin.comentarios.editar')->with('comentario', $comentario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comentario $comentario)
    {       
        //Validacion 

        $rules = [
            'contenido'=>'required',
        ];   

        $data = $request->validate($rules);

        $comentario->contenido = $data['contenido'];
        $comentario->save();    

        return redirect()->action('AdminComentariosController@index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comentario $comentario)
    {
        $comentario->delete();   

        return redirect()->action('AdminComentariosController@index');
    }

    public function search(Request $request)
    {    
        $busqueda = $request->get('buscar');

        $comentarios = Comentario::where('contenido', 'like', '%' . $busqueda . '%')->paginate(10);
        $comentarios->appends(['buscar' => $busqueda]);

        return view('admin.comentarios.index')->with('comentarios', $comentarios)->with('busqueda', $busqueda);
    }
}
