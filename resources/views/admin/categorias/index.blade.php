@extends('admin.layout')

@section('botones')
<a href="{{action('AdminCategoriasController@create')}}" class="btn btn-primary mr-1">Crear categoría</a>
@endsection

@section('content')
    <form class="form-inline mb-5 justify-content-center" action={{ route('admin.categorias.buscar') }}>
        <h2 class="text-center mr-5">Administrar categorías de chollos</h2>
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

            @foreach($cats as $categoria)
            <tr>
            <td>{{$categoria->nombre}}</td>
            <td>{{$categoria->descripcion}}</td>
            <td>
                <a href="{{action('AdminCategoriasController@edit', ['categoria' => $categoria->id])}}" class="btn btn-dark mr-1 btn-sm">Editar</a> 
                <eliminar-categoria categoria-id={{$categoria->id}}>
                </eliminar-categoria>          
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="col-12 mt-4 justify-content-center d-flex">
    {{$cats->links()}}
    </div>
@endsection