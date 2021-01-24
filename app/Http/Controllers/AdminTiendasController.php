<?php

namespace App\Http\Controllers;

use App\TiendaChollo;
use Illuminate\Http\Request;

class AdminTiendasController extends Controller
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
        $tds = TiendaChollo::paginate(10);
        
        return view('admin.tiendas.index')->with('tds', $tds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tiendas.crear');
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
            'url'=> 'required|url',
        ];   

        $data = $request->validate($rules);

        //Guardar en BD
        TiendaChollo::create([
            'nombre'=>$data['nombre'],
            'descripcion'=>$data['descripcion'],
            'url'=>$data['url'],
        ]);

    return redirect()->action('AdminTiendasController@index');
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
    public function edit(TiendaChollo $tienda)
    {
        return view('admin.tiendas.editar')->with('tienda', $tienda);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TiendaChollo $tienda)
    {
        //Validacion 

        $rules = [
            'nombre'=>'required|min:5',
            'descripcion'=> 'required|min:5',
            'url'=> 'required|url',
        ];   

        $data = $request->validate($rules);

        $tienda->nombre = $data['nombre'];
        $tienda->descripcion = $data['descripcion'];
        $tienda->url = $data['url'];

        $tienda->save();

        return redirect()->action('AdminTiendasController@index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TiendaChollo $tienda)
    {
        $tienda->delete();
        
        return redirect()->action('AdminTiendasController@index');
    }

    public function search(Request $request)
    {      
        $busqueda = $request->get('buscar');

        $tds = TiendaChollo::where('nombre', 'like', '%' . $busqueda . '%')->paginate(10);
        $tds->appends(['buscar' => $busqueda]);

        return view('admin.tiendas.index')->with('tds', $tds)->with('busqueda', $busqueda);
    }
}
