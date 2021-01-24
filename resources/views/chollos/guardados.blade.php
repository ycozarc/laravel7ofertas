@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="titulo-categoria text-uppercase mb-4">
            CHOLLOS GUARDADOS</h2> 
        <div class="row mb-5">
            @if ( count( $usuario->follow ) > 0 )
                @foreach($usuario->follow as $chollo)
                    @include('ui.cholloHorizontal')
                @endforeach
            @else
                <p class="ml-4">Aún no tienes ningún chollo guardado!<br>
                <small>Dale a guardar chollo a los que quieras guardar</small>
                </p>
            @endif
        </div> 
        </div>
@endsection