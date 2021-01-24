@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="titulo-categoria text-uppercase mb-4">Últimos chollos</h2>
    <div class="row">
        @foreach($ultimoschollos as $chollo)
            @include('ui.chollo')
        @endforeach
        <p class="text-primary font-weight-bold ml-3 mt-3">
            <a href="{{ route('chollos.ultimos') }}" class="text-reset">Ver más</a>
          </p>
    </div>
</div>
<div class="container">
    <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Populares</h2>
    <div class="row">
        @foreach($maspopulares as $chollo)
            @include('ui.chollo')
        @endforeach
        <p class="text-primary font-weight-bold ml-3 mt-3">
            <a href="{{ route('chollos.populares') }}" class="text-reset">Ver más</a>
          </p>
    </div>
</div> 
@foreach($chollos as $key => $categoria)
@php
    $cat = explode("separador", $key);
@endphp

<div class="container">
    <h2 class="titulo-categoria text-uppercase mt-5 mb-4"> {{ str_replace('-', ' ', $cat[0])}}</h2>
    <div class="row">
        @foreach ($categoria as $chollos)
        @foreach($chollos as $chollo) 
            @include('ui.chollo')
        @endforeach
        @endforeach
    </div>
</div>
<p class="text-primary font-weight-bold ml-3 mt-3">
    <a href="{{ route('categorias.ver', ['categoriaChollo' => $cat[1] ]) }}" class="text-reset">Ver más</a>
  </p>    
@endforeach
@endsection