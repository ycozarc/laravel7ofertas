@extends('admin.layout')

@section('content')
    <form class="form-inline mb-5 justify-content-center" action={{ route('admin.comentarios.buscar') }}>
        <h2 class="text-center mr-5">Administrar comentarios</h2>
        <input type="search" name="buscar" class="form-control mr-sm-2" placeholder="Buscar"/>
    </form>
<div class="align-middle inline-block min-w-full shadow overflow-hidden rounded-lg border-b border-gray-200">
    <table class="table">
        <thead class="bg-primary text-light">
        <tr>
            <th scole="col">Usuario</th>
            <th scole="col">Contenido</th>
            <th scole="col">Chollo</th>
            <th scole="col">Acciones</th>
        </tr>
        </thead>
        <tbody>

            @foreach($comentarios as $comentario)
            <tr>
            <td>{{$comentario->user->name}}</td>
            <td>{{$comentario->contenido}}</td>
            <td>{{$comentario->chollo->titulo}}</td>
            <td>
                <a href="{{action('AdminComentariosController@edit', ['comentario' => $comentario->id])}}" class="btn btn-dark mr-1 btn-sm">Editar</a> 
                <eliminar-comentario comentario-id={{$comentario->id}}>
                </eliminar-comentario>          
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="col-12 mt-4 justify-content-center d-flex">
    {{$comentarios->links()}}
    </div>
@endsection