@extends('layouts.app')
@if( auth()->user() && $perfil->usuario->id==auth()->user()->id)
@section('botones')
  <a href="{{action('PerfilController@edit', ['perfil' => $perfil->usuario->id])}}" class="btn btn-primary ml-4 mt-5">Editar</a>
@endsection
@endif
@section('content')

<div class="container mb-5">
    <div class="main-body"> 
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                      <img src="/storage/{{$perfil->imagen}}" class="rounded-circle" width="200">             
                    <div class="mt-3">
                      <h4>{{$perfil->usuario->name}}</h4>
                      @if($perfil->usuario->isOnline())
                      <span class="badge badge-success mb-2">Conectado</span><br>
                      @else
                      <span class="badge badge-danger mb-2">Desconectado</span><br>
                        @endif
                        Miembro desde: <fecha-chollo fecha="{{$perfil->usuario->created_at}}"></fecha-chollo>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6>Comentarios</h6>
                    @if ($perfil->usuario->comentarios())
                    <span class="text-secondary">{{$perfil->usuario->comentarios()->count()}}</span>
                    @else
                    <span class="text-secondary">0</span>
                    @endif
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6>Chollos publicados</h6>
                    @if ($perfil->usuario->chollos())
                    <span class="text-secondary">{{$perfil->usuario->chollos()->count()}}</span>
                    @else
                    <span>0</span>
                    @endif
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
                    @if ($perfil->web)
                    <span class="text-secondary"><a href="{{$perfil->web}}">Ir</a></span>
                    @endif
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                    <h2 class="text-primary">Información</h2>
                    @if ($perfil->descripcion)
                        {!! $perfil->descripcion !!}
                        @else
                        <p>No hay información para mostrar</p>
                    @endif
                    
                </div>
              </div>
              <div class="card mb-3">
                <div class="card-body">
                    <h2 class="mb-5 text-primary">Chollos publicados</h2>
                    <ul class="list-group mb-4">
                      @foreach( $chollos as $chollo )
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                              <p> {{$chollo->titulo}}</p>
                              <a class="btn btn-outline-primary text-uppercase font-weight-bold" href="{{ route('chollos.show', ['chollo' => $chollo->id ])}}">Ver</a>
                          </li>
                      @endforeach
                  </ul>
                    <div class="d-flex justify-content-center">
                      {{$chollos->links()}}
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection

