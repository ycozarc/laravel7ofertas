<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class AdminRolesController extends Controller
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
        $roles = Role::paginate(10);
        
        return view('admin.roles.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.crear');
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
            'nombre'=>'required',
            'descripcion'=> 'required',
        ];   

        $data = $request->validate($rules);

        //Guardar en BD
        Role::create([
            'name'=>$data['nombre'],
            'description'=>$data['descripcion'],
        ]);

    return redirect()->action('AdminRolesController@index');
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
    public function edit(Role $rol)
    {
        return view('admin.roles.editar')->with('rol', $rol);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $rol)
    {
        //Validacion 

        $rules = [
            'nombre'=>'required',
            'descripcion'=> 'required',
        ];   

        $data = $request->validate($rules);

        $rol->name = $data['nombre'];
        $rol->description = $data['descripcion'];

        $rol->save();

        return redirect()->action('AdminRolesController@index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $rol)
    {           
        $rol->delete();
              
        return redirect()->action('AdminRolesController@index');
    }

    public function search(Request $request)
    {       
        $busqueda = $request->get('buscar');

        $roles = Role::where('name', 'like', '%' . $busqueda . '%')->paginate(10);
        $roles->appends(['buscar' => $busqueda]);

        return view('admin.roles.index')->with('roles', $roles)->with('busqueda', $busqueda);
    }
}
