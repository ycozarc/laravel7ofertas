@extends('admin.layout')

@section('content')
<h2 class="text-center mb-5">Editar rol</h2>
<div class="row col-md-12 justify-content-center ml-3 mr-3">
    <div class="card col-md-8 mt-2 mb-5">
        <div class="mt-3 mr-3 ml-3">
    <form method="POST" action="{{route('admin.roles.update',['rol' => $rol->id])}}" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" 
            name="nombre" 
            class="form-control @error('nombre') is-invalid @enderror" 
            id="nombre" 
            placeholder="Nombre del rol"
            value="{{$rol->name}}"
            >
        
        @error('nombre')
            <span class="invalid-feedback d-block" role="alert">
            <strong>{{$message}}</strong>
            </span>
        @enderror
        </div>

        <div class="form-group mt-4">
            <label for="descripcion">Descripción</label>
            <input type="text" 
            name="descripcion" 
            class="form-control @error('descripcion') is-invalid @enderror" 
            id="descripcion" 
            placeholder="Descripción corta del rol"
            value="{{$rol->description}}"
            >
        
        @error('descripcion')
            <span class="invalid-feedback d-block" role="alert">
            <strong>{{$message}}</strong>
            </span>
        @enderror
        </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Editar rol">
            </div>
        </form>
    </div>
    </div>

</div>
@endsection
