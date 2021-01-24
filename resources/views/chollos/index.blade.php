@extends('layouts.app')

@section('content')
<h2 class="titulo-categoria text-uppercase mb-4">
    MIS CHOLLOS</h2> 

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
                @if($chollo->moderado)
                    <span class="badge badge-success">Verificado</span>
                @else
                    <span class="badge badge-warning">Esperando moderación</span>
                @endif
               
            </td>
            <td>
            <estado-chollo 
            estado="{{$chollo->activo}}"
            chollo-id="{{$chollo->id}}"
            >
            </estado-chollo>              
            </td>
            <td>
            <a href="{{action('CholloController@show', ['chollo' => $chollo->id])}}" class="btn btn-primary btn-sm mr-2">Ver</a>
                <a href="{{action('CholloController@edit', ['chollo' => $chollo->id])}}" class="btn btn-dark btn-sm mr-2">Editar</a>
                <eliminar-chollo chollo-id={{$chollo->id}}>
                </eliminar-chollo>              
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
