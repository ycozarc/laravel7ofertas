@extends('admin.layout')

@section('content')
<h2 class="text-center mb-5">Editar comentario</h2>
<div class="row col-md-12 justify-content-center ml-3 mr-3">
    <span class="font-weight-bold mr-1">Usuario: </span> <a class="text-primary mr-3"  href="{{ route('perfiles.show', ['perfil' => $comentario->user->id ]) }} ">
        {{$comentario->user->name}}
     </a>
    <span class="font-weight-bold mr-1">Comentario del chollo: </span> <a class="text-primary"  href="{{ route('chollos.show', ['chollo' => $comentario->chollo->id ]) }} ">
        {{$comentario->chollo->titulo}}
     </a>
</div>
<div class="row col-md-12 justify-content-center ml-3 mr-3 mt-4">
    <div class="card col-md-8 mt-2 mb-5">
        <div class="mt-3 mr-3 ml-3">
    <form method="POST" action="{{route('admin.comentarios.update',['comentario' => $comentario->id])}}" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="contenido">Comentario</label>
            <textarea 
            name="contenido" 
            class="form-control @error('contenido') is-invalid @enderror" 
            id="contenido" 
            placeholder="Contenido del comentario"
            >{{$comentario->contenido}}</textarea>
        
        @error('contenido')
            <span class="invalid-feedback d-block" role="alert">
            <strong>{{$message}}</strong>
            </span>
        @enderror
        </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Editar comentario">
            </div>
        </form>
    </div>
    </div>

</div>
@endsection
