<form action="{{route('comentarios.store', $chollo)}}" method="POST">
	@csrf
	
	@if (isset($comentario->id))
		<input type="hidden" name="parent_id" value="{{$comentario->id}}">
	@endif
	
	<input type="hidden" name="user_id" value="{{\auth()->id()}}">
 	
 	<div class="form-group">
		<label for="contenido">Mensaje:</label>
		<textarea class="form-control" name="contenido" id="contenido"></textarea>
	</div>
  	<button type="submit" class="btn btn-primary">Enviar comentario</button>
</form>
