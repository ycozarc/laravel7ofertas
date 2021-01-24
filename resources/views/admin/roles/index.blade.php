@extends('admin.layout')

@section('botones')
<a href="{{action('AdminRolesController@create')}}" class="btn btn-primary mr-1">Crear rol</a>
@endsection

@section('content')
    <form class="form-inline mb-5 justify-content-center" action={{ route('admin.roles.buscar') }}>
        <h2 class="text-center mr-5">Administrar roles</h2>
        <input type="search" name="buscar" class="form-control mr-sm-2" placeholder="Buscar"/>
    </form>
<div class="align-middle inline-block min-w-full shadow overflow-hidden rounded-lg border-b border-gray-200">
    <table class="table">
        <thead class="bg-primary text-light">
        <tr>
            <th scole="col">Nombre</th>
            <th scole="col">Descripción</th>
            <th scole="col">Acciones</th>
        </tr>
        </thead>
        <tbody>

            @foreach($roles as $rol)
            <tr>
            <td>{{$rol->name}}</td>
            <td>{{$rol->description}}</td>
            <td>
                <a href="{{action('AdminRolesController@edit', ['rol' => $rol->id])}}" class="btn btn-dark mr-1 btn-sm">Editar</a> 
                <eliminar-rol rol-id={{$rol->id}}>
                </eliminar-rol>          
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="col-12 mt-4 justify-content-center d-flex">
    {{$roles->links()}}
    </div>
@endsection