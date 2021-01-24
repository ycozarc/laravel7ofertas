@extends('admin.layout')

@section('botones')
<a href="{{action('AdminTiendasController@create')}}" class="btn btn-primary mr-1">Crear tienda</a>
@endsection

@section('content')
    <form class="form-inline mb-5 justify-content-center" action={{ route('admin.tiendas.buscar') }}>
        <h2 class="text-center mr-5">Administrar tiendas de chollos</h2>
        <input type="search" name="buscar" class="form-control mr-sm-2" placeholder="Buscar"/>
    </form>
<div class="align-middle inline-block min-w-full shadow overflow-hidden rounded-lg border-b border-gray-200">
    <table class="table">
        <thead class="bg-primary text-light">
        <tr>
            <th scole="col">Nombre</th>
            <th scole="col">Descripción</th>
            <th scole="col">Url</th>
            <th scole="col">Acciones</th>
        </tr>
        </thead>
        <tbody>

            @foreach($tds as $tienda)
            <tr>
            <td>{{$tienda->nombre}}</td>
            <td>{{$tienda->descripcion}}</td>
            <td>{{$tienda->url}}</td>
            <td>
                <a href="{{action('AdminTiendasController@edit', ['tienda' => $tienda->id])}}" class="btn btn-dark mr-1 btn-sm">Editar</a> 
                <eliminar-tienda tienda-id={{$tienda->id}}>
                </eliminar-tienda>          
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="col-12 mt-4 justify-content-center d-flex">
    {{$tds->links()}}
    </div>
@endsection