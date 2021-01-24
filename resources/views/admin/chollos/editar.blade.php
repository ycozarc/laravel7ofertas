@extends('admin.layout')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css" integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg==" crossorigin="anonymous" />
@endsection


@section('content')
<h2 class="text-center mb-5">Editar chollo: {{$chollo->titulo}}</h2>
<div class="row col-md-12 justify-content-center ml-3 mr-3">
    <div class="card col-md-8 mt-2 mb-5">
        <div class="mt-3 mr-3 ml-3">
    <form method="POST" action="{{route('admin.chollos.update',['chollo' => $chollo->id])}}" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
            <div class="form-group">
                <label for="titulo">Titulo</label>
                <input type="text" 
                name="titulo" 
                class="form-control @error('titulo') is-invalid @enderror" 
                id="titulo" 
                placeholder="Titulo del chollo"
                value="{{$chollo->titulo}}"
                >
            
            @error('titulo')
                <span class="invalid-feedback d-block" role="alert">
                <strong>{{$message}}</strong>
                </span>
            @enderror
            </div>

            <div class="from-group">
                <label for="categoria">Categoria</label>
                <select
                    name="categoria"
                    class="form-control @error('categoria') is-invalid @enderror"
                    id="categoria"
                    >
                    <option value="">--Selecciona una categoria--</option>
                    @foreach($categorias as $categoria)
            <option value="{{$categoria->id}}" {{ $chollo->categoria_id == $categoria->id ? 'selected' : ''}}>{{$categoria->nombre}}</option>
                    @endforeach
                </select>
                @error('categoria')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>

            <div class="from-group mt-4">
                <label for="tienda">Tienda</label>
                <select
                    name="tienda"
                    class="form-control @error('tienda') is-invalid @enderror"
                    id="tienda"
                    >
                    <option value="">--Selecciona una tienda--</option>
                    @foreach($tiendas as $tienda)
            <option value="{{$tienda->id}}" {{$chollo->tienda_id == $tienda->id ? 'selected' : ''}}>{{$tienda->nombre}}</option>
                    @endforeach
                </select>
                @error('tienda')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-4">
                <label for="url">Url de la oferta</label>
                <input type="text" 
                name="url" 
                class="form-control @error('url') is-invalid @enderror" 
                id="url" 
                placeholder="Url del chollo"
                value={{$chollo->url}}
                >
            
            @error('url')
                <span class="invalid-feedback d-block" role="alert">
                <strong>{{$message}}</strong>
                </span>
            @enderror
            </div>

            <div class="form-group mt-4">
                <label for="producto">Marca y modelo del producto</label>
                <input type="text" 
                name="producto" 
                class="form-control @error('producto') is-invalid @enderror" 
                id="producto" 
                placeholder="Si es un producto, indica su marca y modelo"
                value="{{$chollo->producto}}"
                >
            
            @error('producto')
                <span class="invalid-feedback d-block" role="alert">
                <strong>{{$message}}</strong>
                </span>
            @enderror
            </div>

            <div class="from-group">
                <label for="tipodescuento">Tipo de descuento</label>
                <select
                    name="tipodescuento"
                    class="form-control @error('tipodescuento') is-invalid @enderror"
                    id="tipodescuento"
                    >
                    <option value="">--Selecciona un tipo de descuento--</option>
                    @foreach($tipodescuentos as $tipo)
                    <option value="{{$tipo->id}}" {{$chollo->tipo_descuento_id == $tipo->id ? 'selected' : ''}}>{{$tipo->nombre}}</option>
                    @endforeach
                </select>
                @error('tipodescuento')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
        <br>
            <div class="form-group" id="descuento" style="@if($errors->has('descuento') || $chollo->tipo_descuento_id == 2) display:block @else display:none @endif ;">
                <label for="descuento">Descuento</label>
                <input type="number"
                name="descuento" 
                class="form-control @error('descuento') is-invalid @enderror" 
                id="descuento" 
                placeholder="Indica el descuento"
                value="{{$chollo->descuento}}"
                >
            
            @error('descuento')
                <span class="invalid-feedback d-block" role="alert">
                <strong>{{$message}}</strong>
                </span>
            @enderror
            </div>

            <div class="form-group" id="precio_anterior" style="@if($errors->has('precio_anterior') || $errors->has('precio_actual')  || $chollo->tipo_descuento_id == 1) display:block @else display:none @endif ;">
                <label for="precio_anterior">Precio anterior</label>
                <input type="number" 
                name="precio_anterior" 
                class="form-control @error('precio_anterior') is-invalid @enderror" 
                id="precio_anterior" 
                placeholder="Precio al que estaba el articulo"
                value="{{$chollo->precio_anterior}}"
                >
            
            @error('precio_anterior')
                <span class="invalid-feedback d-block" role="alert">
                <strong>{{$message}}</strong>
                </span>
            @enderror
            </div>

            <div class="form-group" id="precio_actual" style="@if($errors->has('precio_actual')  || $chollo->tipo_descuento_id == 1) display:block @else display:none @endif ;" >
                <label for="precio_actual">Precio actual</label>
                <input type="number" 
                name="precio_actual" 
                class="form-control @error('precio_actual') is-invalid @enderror" 
                id="precio_actual" 
                placeholder="Precio al que está la oferta"
                value="{{$chollo->precio_actual}}"
                >
            
            @error('precio_actual')
                <span class="invalid-feedback d-block" role="alert">
                <strong>{{$message}}</strong>
                </span>
            @enderror
            </div>

            <div class="form-group" id="gratis" style="@if($errors->has('gratis') || $chollo->tipo_descuento_id == 3) display:block @else display:none @endif ;">
                <label for="gratis">Precio oferta</label>
                <input type="number" 
                name="gratis" 
                class="form-control @error('gratis') is-invalid @enderror" 
                id="gratis" 
                placeholder="Precio al que estaba el articulo"
                value="0" readonly="readonly"
                >
            
            @error('gratis')
                <span class="invalid-feedback d-block" role="alert">
                <strong>{{$message}}</strong>
                </span>
            @enderror
            </div>

            <div class="form-group">
                <label for="cupon">Cupón</label>
                <input type="text" 
                name="cupon" 
                class="form-control @error('cupon') is-invalid @enderror" 
                id="cupon" 
                placeholder="Indica el cupón si es que lo tiene"
                value={{$chollo->cupon}}
                >
            
            @error('cupon')
                <span class="invalid-feedback d-block" role="alert">
                <strong>{{$message}}</strong>
                </span>
            @enderror
            </div>
            <div class="form-group mt-4">
                <label for="descripcion">Descripción</label>
            <input id="descripcion" type="hidden" name="descripcion" value="{{$chollo->descripcion}}">
            <trix-editor class="form-control @error('descripcion') is-invalid @enderror" input="descripcion" style="overflow-y:auto; min-height:350px;"></trix-editor>
            @error('descripcion')
                <span class="invalid-feedback d-block" role="alert">
                <strong>{{$message}}</strong>
                </span>
            @enderror
            </div>

            <div class="form-group mt-4">
                <label for="descripcion">Elige una imagen</label>
                <input id="imagen" type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen">
                <div class="mt-4">
                    <p>Imagen actual:</p>
                <img src="/storage/{{$chollo->imagen}}" style="width: 300px">
                </div>
                
                @error('imagen')
                <span class="invalid-feedback d-block" role="alert">
                <strong>{{$message}}</strong>
                </span>
            @enderror
            
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Editar chollo">
            </div>
        </form>
    </div>
    </div>

</div>


@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js" integrity="sha512-S9EzTi2CZYAFbOUZVkVVqzeVpq+wG+JBFzG0YlfWAR7O8d+3nC+TTJr1KD3h4uh9aLbfKIJzIyTWZp5N/61k1g==" crossorigin="anonymous" defer></script>
@endsection