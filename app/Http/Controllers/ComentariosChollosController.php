<?php

namespace App\Http\Controllers;

use App\Chollo;
use App\Comentario;
use App\User;
use Illuminate\Http\Request;

class ComentariosChollosController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'verified']);
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
    public function create(Request $request)
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Chollo $chollo)
    {
        $data = request()->validate([
            'contenido'=>'required'
        ]);

        $comentario = new Comentario();
        $comentario->contenido = $request->contenido;
        $comentario->parent_id = $request->parent_id;
        $comentario->user_id = auth()->user()->id;
 
        $chollo->comentarios()->save($comentario);
 
        return \redirect()->route('chollos.show', $chollo);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comentario $comentario)
    {
        if (auth()->user()->tieneRol(['admin'])){
            $comentario->delete();
        }
    
        return \redirect()->route('chollos.show', $comentario->chollo);
    }
}
