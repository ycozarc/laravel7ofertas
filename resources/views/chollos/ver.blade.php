@extends('layouts.app')

@section('content')
<div class="container">
  <div class="main-body"> 
        <div class="row gutters-sm">
          <div class="col-md-9 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="container chollo-meta pl-3 mt-2">
                  <div class="row">
                    <div class="col-xs mr-4 mb-5">
                      <img src="/storage/{{$chollo->imagen}}" width="250" height="250">
                    </div>
                    <div>
                      <megusta-chollo
                      chollo-id="{{$chollo->id}}"
                      like="{{$like}}"
                      likes="{{$likes}}"
                    >
                    </megusta-chollo>
                    </div>
                    <div class="col-sm mt-2">
                      <p>
                        <h5 class="font-weight-bold">{{$chollo->titulo}}</h5>
                                  @if($chollo->tipodescuento->id==2)
                                  <span class="font-weight-bold text-primary mr-2" style="font-size: 20px;">{{$chollo->descuento}}% de descuento</span>
                                  @else
                                  @if($chollo->precio_actual == null | $chollo->precio_actual == 0)
                                <span class="font-weight-bold text-primary mr-2" style="font-size: 40px;">Gratis</span>
                                @else
                                  <span class="font-weight-bold text-primary mr-2" style="font-size: 30px;">{{$chollo->precio_actual}}€</span>
                                @endif
                                @if($chollo->precio_anterior)
                                <span class="font-weight-bold mr-3" style="text-decoration:line-through; color:grey;">{{$chollo->precio_anterior}}€</span>
                                @endif 
                                  @endif
                                       
                          <span>Tienda:</span>
                          <a class="mr-3 font-weight-bold" href="{{ route('tiendas.ver', ['tiendaChollo' => $chollo->tienda->id ]) }}">
                            {{$chollo->tienda->nombre}}
                         </a>
              
                          <span>Categoría:</span>
                          <a class="mr-3 font-weight-bold" href="{{ route('categorias.ver', ['categoriaChollo' => $chollo->categoria->id ]) }}">
                            {{$chollo->categoria->nombre}}
                         </a>
                      </p>
                      <p>
                        <div class="d-flex flex-row">
                          <div class="mr-4">
                            <a href="{{$chollo->url}}" class="{{$chollo->activo ? 'btn-primary' : 'btn-secondary'}} btn btn-lg mr-2 text-white">
                                Ir al chollo
                              <svg style="width: 15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a> 
                          </div>
                          <div class="col-sm-5 borde-cupon rounded p-1 text-center">
                            @if($chollo->cupon==null)
                            <h6 class="font-weight-bold text-primary mt-2">No necesita cupón</h6>
                            @else
                            <copiar-cupon 
                            cupon={{$chollo->cupon}}
                            chollo-id={{$chollo->id}}
                            activo={{$chollo->activo}}
                            >
                            </copiar-cupon> 
                            @endif
                          </div>             
                       </div>
                       <div class="d-flex flex-row">
                        <div class="mt-4">
                          <img src="/storage/{{$chollo->user->perfil->imagen}}" width="35" height="35" class="rounded-circle mr-1">
                          <a class="font-weight-bold text-dark"  href="{{ route('perfiles.show', ['perfil' => $chollo->user->id ]) }} ">
                            {{$chollo->user->name}}
                         </a>
                        </div>
                       </div>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="card mt-5" style="width: 23rem;">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"/>
                        <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                      </svg>
                      @php
                       $fecha = $chollo->created_at
                      @endphp
                      <small class="text-secondary">Publicado el <fecha-chollo fecha="{{$fecha}}"></fecha-chollo> ({{ $chollo->created_at->diffForHumans() }})</small>
                    </li>
                  </ul>
                </div>
                <div class="descripcion mt-5">
                  {!! $chollo->descripcion !!}   
              </div>
              <div class="mt-5">
              <a class="btn btn-facebook ml-2" target="popup" onclick="window.open('https://www.facebook.com/sharer.php?u={{$urlActual}}&t={{$chollo->titulo}}','popup','width=600,height=600'); return false;">Facebook </a>
              <a class="btn btn-twitter" target="popup" onclick="window.open('https://twitter.com/intent/tweet?url={{$urlActual}}&text={{$chollo->titulo}}','popup','width=600,height=600'); return false;">Twitter </a>
            </div>
              <div class="mt-5 d-flex justify-content-between">
                <seguir-chollo
                  chollo-id="{{$chollo->id}}"
                  follow="{{$follow}}">
                </seguir-chollo>
                @if($chollo->producto && count($masBajo) > 1 && $masBajo[0]->id!=$chollo->id)
                <div class="card bg-danger ml-5" style="width: 30rem;">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#900B0B" class="bi bi-exclamation-circle-fill mr-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                      </svg>
                      @php
                       $fecha = $chollo->created_at
                      @endphp
                      <small>El producto estuvo a {{$masBajo[0]->precio_actual}}€ el <fecha-chollo fecha="{{$fecha}}"></fecha-chollo> en {{$masBajo[0]->tienda->nombre}}. 
                        @if($masBajo[0]->activo)
                        <a href="{{ route('chollos.show', ['chollo' => $masBajo[0]->id ])}}" class="text-primary ml-1">Ver</a>
                      @endif</small>
                    </li>
                  </ul>
                </div>
                @endif
              </div>
              </div>
            </div>
            <div class="card mt-3 mb-5">
              <div class="card-header bg-dark text-white">
                Comentarios
              </div>
              <div class="card-body">
                @if(count($comentarios) > 0)
                @include('comentarios.lista', ['comentarios' => $comentarios])
                <div class="col-12 mt-4 justify-content-center d-flex">
                  {{$comentarios->links()}}
                  </div>
                  @else
                  <br>
                  <p>No hay comentarios, se el primero!</p>
                @endif
                <div class="pt-4">            
                @include('comentarios.formulario')
                </div>
              </div>
              </div>
          </div>
          <div class="col-md-3">
            <div class="card mb-3">
              <div class="card-body">
                  <h3 class="text-primary">Últimos chollos</h3>
                  <ul class="list-group mb-4 mt-3">
                    @foreach( $ultimos as $chollo )
                        <li class="list-group-item justify-content-between align-items-center border-0">
                            <img src="/storage/{{$chollo->imagen}}" width="75" height="75" class="mb-1">
                            <p> {{$chollo->titulo}}
                            @if($chollo->precio_actual == null | $chollo->precio_actual == 0)
                                <span class="ml-2 font-weight-bold {{$chollo->activo ? 'text-primary' : 'text-secondary'}}">Gratis</span>
                                @else
                                  <span class="ml-2 font-weight-bold {{$chollo->activo ? 'text-primary' : 'text-secondary'}}">{{$chollo->precio_actual}}€</span>
                                @endif
                              </p>
                            <a class="btn {{$chollo->activo ? 'btn-outline-primary' : 'btn-outline-secondary'}}  text-uppercase font-weight-bold" href="{{ route('chollos.show', ['chollo' => $chollo->id ])}}">Ver</a>
                        </li>
                    @endforeach
                      <a href="{{ route('chollos.ultimos') }}" class="ml-3 mt-4 text-primary">Ver más</a>
                </ul>
              </div>
            </div>
            <div class="card mb-5">
              <div class="card-body">
                  <h3 class="mb-4 text-primary">Populares</h3>
                  <ul class="list-group mb-4">
                    @foreach( $populares as $chollo )
                        <li class="list-group-item justify-content-between align-items-center border-0">
                            <img src="/storage/{{$chollo->imagen}}" width="75" height="75" class="mb-1">
                            <p> {{$chollo->titulo}}
                            @if($chollo->precio_actual == null | $chollo->precio_actual == 0)
                                <span class="ml-2 font-weight-bold {{$chollo->activo ? 'text-primary' : 'text-secondary'}}">Gratis</span>
                                @else
                                  <span class="ml-2 font-weight-bold {{$chollo->activo ? 'text-primary' : 'text-secondary'}}">{{$chollo->precio_actual}}€</span>
                                @endif
                              </p>
                            <a class="btn {{$chollo->activo ? 'btn-outline-primary' : 'btn-outline-secondary'}}  text-uppercase font-weight-bold" href="{{ route('chollos.show', ['chollo' => $chollo->id ])}}">Ver</a>
                        </li>
                    @endforeach
                      <a href="{{ route('chollos.populares') }}" class="ml-3 mt-4 text-primary">Ver más</a>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>


@endsection