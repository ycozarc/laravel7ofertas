@foreach($comentarios as $comentario)
	@include('comentarios.comentario', ['comentario' => $comentario])
@endforeach