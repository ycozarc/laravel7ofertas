@extends('admin.layout')

@section('content')
        <h2 class="text-center mb-5">Moderar chollos</h2>
<div class="align-middle inline-block min-w-full shadow overflow-hidden rounded-lg border-b border-gray-200">
    <table class="table">
        <thead class="bg-primary text-light">
        <tr>
            <th scole="col">Titulo</th>
            <th scole="col">Categoría</th>
            <th scole="col">Moderado</th>
            <th scole="col">Estado</th>
            <th scole="col">Acciones</th>
        </tr>
        </thead>
        <tbody>

            @foreach($chollos as $chollo)
            <tr>
            <td>{{$chollo->titulo}}</td>
            <td>{{$chollo->categoria->nombre}}</td>
            <td>
                <moderar-chollo 
                    moderado="{{$chollo->moderado}}"
                    chollo-id="{{$chollo->id}}"
                >
                </moderar-chollo>   
            </td>
            <td>
            <estado-chollo 
            estado="{{$chollo->activo}}"
            chollo-id="{{$chollo->id}}"
            >
            </estado-chollo>              
            </td>
            <td>
            <a href="{{action('CholloController@show', ['chollo' => $chollo->id])}}" class="btn btn-success mr-1 btn-sm">Ver</a>
                <a href="{{action('AdminCholloController@edit', ['chollo' => $chollo->id])}}" class="btn btn-dark mr-1 btn-sm">Editar</a>
                <eliminar-chollo-admin chollo-id={{$chollo->id}}>
                </eliminar-chollo-admin>              
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="col-12 mt-4 justify-content-center d-flex">
    {{$chollos->links()}}
    </div>
@endsection
