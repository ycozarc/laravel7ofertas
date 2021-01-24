@extends('admin.layout')

@section('content')
<h2 class="text-center mb-5">Editar usuario</h2>
<div class="row col-md-12 justify-content-center ml-3 mr-3">
    <div class="card col-md-8 mt-2">
        <div class="mt-3 mr-3 ml-3">
            <form method="POST" action="{{route('admin.usuarios.update',['user' => $user->id])}}" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" 
                name="name" 
                class="form-control @error('name') is-invalid @enderror" 
                id="name" 
                placeholder="Nombre de usuario"
                value="{{$user->name}}"
                >
            
            @error('name')
                <span class="invalid-feedback d-block" role="alert">
                <strong>{{$message}}</strong>
                </span>
            @enderror
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" 
                name="email" 
                class="form-control @error('email') is-invalid @enderror" 
                id="email" 
                placeholder="Email"
                value="{{$user->email}}"
                >
            
            @error('email')
                <span class="invalid-feedback d-block" role="alert">
                <strong>{{$message}}</strong>
                </span>
            @enderror
            </div>

            <div class="form-group mt-4">
                <label for="password">Contraseña</label>
                <input type="password" 
                name="password" 
                class="form-control @error('password') is-invalid @enderror" 
                id="password" 
                >            
            @error('password')
                <span class="invalid-feedback d-block" role="alert">
                <strong>{{$message}}</strong>
                </span>
            @enderror
            </div>
            <div class="form-group mt-4">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                 <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"
                 >
            </div>
            <div class="form-group mt-4">
                <label for="password">Roles</label>
            @foreach($roles as $rol)
                <div class="checkbox">
                    <label>
                    <input type="checkbox" name="roles[]" for="roles"  value="{{$rol->id}}"
                    {{$user->roles->contains($rol->id) ? 'checked':''}}>
                    {{$rol->description}}
                    </label>
                </div>
            @endforeach
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Editar usuario">
            </div>
        </form>
    </div>
</div>
</div>
@endsection
