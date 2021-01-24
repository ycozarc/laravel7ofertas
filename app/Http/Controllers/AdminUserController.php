<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
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
        $users = User::paginate(10);

        return view('admin.usuarios.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.usuarios.crear');
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

        $data = request()->validate([
            'name' =>'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' =>'required|string|min:8|confirmed'
        ]);   

            //Guardar en BD
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $user->roles()->attach(Role::where('name', 'user')->first());
         
        return redirect()->action('AdminUserController@index');

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
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.usuarios.editar')->with('roles', $roles)->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {      
            //Validacion 

        $rules = [
            'name' =>'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ];   

        if ($request->filled('password'))
        {
            $rules['password'] = 'confirmed|min:5';
        }

        $data = $request->validate($rules);

        $user->roles()->sync($request->roles);

        $user->update($data);
        
        

        return redirect()->action('AdminUserController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->action('AdminUserController@index');
    }

    public function search(Request $request)
    {        
        $busqueda = $request->get('buscar');

        $users = User::where('name', 'like', '%' . $busqueda . '%')->paginate(10);
        $users->appends(['buscar' => $busqueda]);

        return view('admin.usuarios.index')->with('users', $users)->with('busqueda', $busqueda);
    }
}
