<?php

namespace App\Http\Controllers;

use App\CategoriaChollo;
use Illuminate\Http\Request;

class AdminCategoriasController extends Controller
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
        $cats = CategoriaChollo::paginate(10);
        
        return view('admin.categorias.index')->with('cats', $cats);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categorias.crear');
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
            'nombre'=>'required|min:5',
            'descripcion'=> 'required|min:5',
        ];   

        $data = $request->validate($rules);

        //Guardar en BD

        CategoriaChollo::create([
            'nombre'=>$data['nombre'],
            'descripcion'=>$data['descripcion'],
        ]);
          
        
    return redirect()->action('AdminCategoriasController@index');
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
    public function edit(CategoriaChollo $categoria)
    {
        return view('admin.categorias.editar')->with('categoria', $categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriaChollo $categoria)
    {     
        //Validacion 

        $rules = [
            'nombre'=>'required|min:5',
            'descripcion'=> 'required|min:5',
        ];   

        $data = $request->validate($rules);

        $categoria->nombre = $data['nombre'];
        $categoria->descripcion = $data['descripcion'];
        $categoria->save();    

        return redirect()->action('AdminCategoriasController@index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriaChollo $categoria)
    {
        $categoria->delete();   

        return redirect()->action('AdminCategoriasController@index');
    }

    public function search(Request $request)
    {      
        $busqueda = $request->get('buscar');

        $cats = CategoriaChollo::where('nombre', 'like', '%' . $busqueda . '%')->paginate(10);
        $cats->appends(['buscar' => $busqueda]);

        return view('admin.categorias.index')->with('cats', $cats)->with('busqueda', $busqueda);
    }
}
