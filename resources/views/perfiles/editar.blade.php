@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css" integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg==" crossorigin="anonymous" />
@endsection

@section('content')
<h2 class="text-center">Editar mi perfil</h2>
<div class="row col-md-12 justify-content-center ml-3 mr-3">
    <div class="card col-md-12 mt-5 mb-5 shadow">
        <div class="mt-3 mr-3 ml-3">  
            <form 
                action="{{ route('perfiles.update', ['perfil' =>$perfil->id ]) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" 
                    name="nombre" 
                    class="form-control @error('nombre') is-invalid @enderror" 
                    id="nombre" 
                    placeholder="Nombre"
                    value="{{$perfil->usuario->name}}"
                    >
                
                @error('nombre')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="descripcion">Descripción</label>
                <input id="descripcion" type="hidden" name="descripcion" value="{{$perfil->descripcion}}">
                <trix-editor class="form-control @error('descripcion') is-invalid @enderror" input="descripcion" style="overflow-y:auto"></trix-editor>
                @error('descripcion')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group">
                    <label for="web">Website</label>
                    <input type="text" 
                    name="web" 
                    class="form-control @error('web') is-invalid @enderror" 
                    id="web" 
                    placeholder="Tienes sitio web? Compártelo"
                    value="{{$perfil->web}}"
                    >
                
                @error('web')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group mt-4">
                    <label for="descripcion">Elige un avatar</label>
                    <input id="imagen" type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen">
                    @if($perfil->imagen)
                    <div class="mt-4">
                        <p>Avatar actual:</p>
                    <img src="/storage/{{$perfil->imagen}}" style="width: 300px">
                    </div>
                    @error('imagen')
                    <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                    </span>
                    @enderror
                    @endif                                  
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Editar perfil">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js" integrity="sha512-S9EzTi2CZYAFbOUZVkVVqzeVpq+wG+JBFzG0YlfWAR7O8d+3nC+TTJr1KD3h4uh9aLbfKIJzIyTWZp5N/61k1g==" crossorigin="anonymous" defer></script>
@endsection