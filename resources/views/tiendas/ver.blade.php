@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <h2 class="titulo-categoria text-uppercase mb-4">
            {{$tiendaNombre}}</h2> 
        <div class="row">
            @foreach($chollos as $chollo)
                @include('ui.chollo')
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{$chollos->links()}}
          </div>
    
        </div>
@endsection