@extends('admin.layout')

@section('content')
<h2 class="text-center mb-5">Editar tienda</h2>
<div class="row col-md-12 justify-content-center ml-3 mr-3">
    <div class="card col-md-8 mt-2 mb-5">
        <div class="mt-3 mr-3 ml-3">
    <form method="POST" action="{{route('admin.tiendas.update',['tienda' => $tienda->id])}}" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" 
            name="nombre" 
            class="form-control @error('nombre') is-invalid @enderror" 
            id="nombre" 
            placeholder="Nombre de la categoría"
            value="{{$tienda->nombre}}"
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
            placeholder="Descripción corta de la categoría"
            value="{{$tienda->descripcion}}"
            >
        
        @error('descripcion')
            <span class="invalid-feedback d-block" role="alert">
            <strong>{{$message}}</strong>
            </span>
        @enderror
        </div>
        <div class="form-group mt-4">
            <label for="url">Url</label>
            <input type="text" 
            name="url" 
            class="form-control @error('url') is-invalid @enderror" 
            id="url" 
            placeholder="Web de la tienda"
            value="{{$tienda->url}}"
            >
        
        @error('url')
            <span class="invalid-feedback d-block" role="alert">
            <strong>{{$message}}</strong>
            </span>
        @enderror
        </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Editar tienda">
            </div>
        </form>
    </div>
    </div>

</div>
@endsection
