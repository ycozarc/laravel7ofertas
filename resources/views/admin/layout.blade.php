<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Admin Panel | Chollos</title>

  <!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
@yield('styles')


  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('inicio.index') }} " class="nav-link">Home</a>
      </li>
    </ul>

    <!-- SEARCH FORM 
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
    -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }} " class="brand-link">
      <img src="/adminlte/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Panel Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/storage/{{auth()->user()->perfil->imagen}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="{{ route('perfiles.show', ['perfil' => auth()->user()->id ]) }} " class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if(auth()->user()->tieneRol('admin') || auth()->user()->tieneRol('mod'))
            <li class="nav-item">
              <a href="{{route('admin.chollos.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Chollos
                    </p>
                  </a>
                </li>
            <li class="nav-item">
              <a href="{{route('admin.chollos.moderar')}}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Moderar Chollos
                      @if($pendientes)
                        <span class="right badge badge-danger">{{$pendientes}}</span>
                      @endif               
                    </p>
                  </a>
                </li>
            <li class="nav-item">
              <a href="{{route('admin.comentarios.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Comentarios
                    </p>
                  </a>
                </li>
          @endif
          @if(auth()->user()->tieneRol('admin'))
            <li class="nav-item">
              <a href="{{route('admin.categorias.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Categorias
                    </p>
                  </a>
                </li>
            <li class="nav-item">
              <a href="{{route('admin.tiendas.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Tiendas
                    </p>
                   </a>
                </li>
            <li class="nav-item">
              <a href="{{route('admin.usuarios.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Usuarios
                    </p>
                  </a>
                </li>
             <li class="nav-item">
              <a href="{{route('admin.roles.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                     <p>
                       Roles
                    </p>
                   </a>
                 </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="py-2 mt-2 col-12">
            @yield('botones')   
        </div>  
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div id="app" class="content">
      @yield('content')
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Realizado por Yeray
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020 <a href="#">Chollos</a>.</strong> Todos los derechos reservados.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- Scripts -->
<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/js/adminlte.min.js"></script>
@yield('scripts')
</body>
</html>
