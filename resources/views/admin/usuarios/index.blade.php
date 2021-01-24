@extends('admin.layout')

@section('botones')
<a href="{{route('admin.usuarios.crear')}}" class="btn btn-primary mr-2 text-white">Crear usuario</a>
@endsection

@section('content')
<form class="form-inline mb-5 justify-content-center" action={{ route('admin.usuarios.buscar') }}>
    <h2 class="text-center mr-5">Administrar usuarios</h2>
    <input type="search" name="buscar" class="form-control mr-sm-2" placeholder="Buscar"/>
</form>
    <div class="mb-5 align-middle inline-block min-w-full shadow overflow-hidden rounded-lg border-b border-gray-200">
    <table class="table">
        <thead class="bg-primary text-light">
        <tr>
            <th scole="col">Usuario</th>
            <th scole="col">Email</th>
            <th scole="col">Acciones</th>
            <th scole="col">Fecha registro</th>
        </tr>
        </thead>
        <tbody>

            @foreach($users as $user)
            <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>              
            <td>
                <a href="{{action('AdminUserController@edit', ['user' => $user->id])}}" class="btn btn-dark mr-1 btn-sm">Editar</a>
                <eliminar-user user-id={{$user->id}}>
                </eliminar-user>          
            </td>
            <td>
                <fecha-chollo fecha="{{$user->created_at}}"></fecha-chollo>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="col-12 mt-4 justify-content-center d-flex">
    {{$users->links()}}
    </div>
@endsection
