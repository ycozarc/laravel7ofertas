<div class="pl-4 pt-4 border-left ">
    <img src="/storage/{{$comentario->user->perfil->imagen}}" width="40" height="40" class="rounded-circle">
    <p class="font-weight-bold"><a class="font-weight-bold text-dark"  href="{{ route('perfiles.show', ['perfil' => $comentario->user->id ]) }} ">
        {{$comentario->user->name}}
     </a>  <small>{{ $comentario->created_at->diffForHumans() }}</small></p>
    <p>{{ $comentario->contenido }}</p>
    <div class="input-group">
        <span class="input-group-btn">
            <p class="btn btn-link pl-0" type="button" data-toggle="collapse" data-target="#respuesta-{{$comentario->id}}" aria-expanded="false" aria-controls="respuesta-{{$comentario->id}}">
                Responder</p>
        </span>
        @if(auth()->user() && auth()->user()->tieneRol(['admin']))
        <form action="{{route('comentarios.destroy', ['comentario' => $comentario->id])}}" method="POST">
            @csrf
            @method('DELETE')
            <input type ="submit" class="btn btn-link pl-0 text-danger" value="Eliminar"></a>
        </form>
        @endif   
    </div>              
    <div class="collapse my-3" id="respuesta-{{$comentario->id}}">
  	<div class="card card-body">
    		@include('comentarios.formulario', ['comentario' => $comentario])
    	</div>
    </div>
 
    @if ($comentario->respuestas)
    	@include('comentarios.lista', ['comentarios' => $comentario->respuestas])
    @endif
</div>