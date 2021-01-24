<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    @yield('styles')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="ml-3 nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white text-uppercase font-weight-bold" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Tiendas
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                @foreach($tiendas as $tienda)
                                <a class="nav-link dropdown-item" href="{{ route('tiendas.ver', ['tiendaChollo' => $tienda->id ]) }}">
                                    {{ $tienda->nombre }}
                                 </a>
                                @endforeach
                            </div>
                          </li>
                          <li class="nav-item active mr-1">
                            <a class="nav-link text-white font-weight-bold" href="{{ route('chollos.gratis') }}">GRATIS</a>
                          </li>
                          <li class="nav-item active mr-1">
                            <a class="nav-link text-white font-weight-bold" href="{{ route('chollos.promociones') }}">PROMOCIONES</a>
                          </li>
                          <li class="nav-item active">
                            <a class="nav-link text-white font-weight-bold" href="{{ route('chollos.cupones') }}">CUPONES</a>
                          </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="mr-4 mt-1">
                            <form class="form-inline" action={{ route('buscar.ver') }}>
                                <input type="search" name="buscar" class="form-control mr-sm-2" placeholder="Buscar"/>
                            </form>
                        </li>
                        <li>
                            <div class="dropdown show mr-5 mt-1">
                                <a class="btn btn-primary font-weight-bold text-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                      </svg>Comparte
                                </a>
                              
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                  <a href="{{route('chollos.create')}}" class="dropdown-item">
                                    <svg class="icono" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    Chollo
                                </a>
                                </div>
                              </div>
                                </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="/storage/{{auth()->user()->perfil->imagen}}" width="35" height="35" class="rounded-circle mr-1">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(auth()->user()->tieneRol('admin') || auth()->user()->tieneRol('mod'))
                                    <a class="dropdown-item" href="{{ route('admin.index') }}">
                                        {{ 'Panel Admin' }}
                                    </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('perfiles.show',['perfil' => Auth::user()->id]) }}">
                                        {{ 'Perfil' }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('chollos.index') }}">
                                        {{ 'Mis chollos' }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('chollos.guardados') }}">
                                        {{ 'Chollos guardados' }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <nav class="navbar navbar-expand-md navbar-light categorias-bg">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#categorias" aria-controls="categorias" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                    Categorias
                </button>
                <div class="collapse navbar-collapse " id="categorias">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav w-100 d-flex justify-content-between">
                        @foreach ($categorias as $categoria)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categorias.ver', ['categoriaChollo' => $categoria->id ]) }}">
                               {{ $categoria->nombre }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                    @yield('botones')             

                <main class="py-4 mt-5 col-12">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    <!-- Footer -->
<footer class="page-footer font-small blue fixed-bottom">

    <!-- Copyright -->
    <div class="bg-dark text-center py-3 text-white">© 2020 Copyright:
      <a href="http://localhost:8000"> Chollos</a>
    </div>
    <!-- Copyright -->
  
  </footer>
  <!-- Footer -->
    @yield('scripts')
</body>
</html>
