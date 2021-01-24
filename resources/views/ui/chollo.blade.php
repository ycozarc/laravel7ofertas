<div class="col-sm-3 mt-4">
    <div class="card shadow" style="height: 500px;">
        <a href="{{ route('chollos.show', ['chollo' => $chollo->id ])}}">
        <img class="card-img-top" src="/storage/{{ $chollo->imagen }}" alt="imagen chollo">
        </a>
        <div class="card-body">
            <a style="color:black" href="{{ route('chollos.show', ['chollo' => $chollo->id ])}}"><h6 class="font-weight-bold text-center {{$chollo->activo ? '' : 'text-secondary'}}">{{ Str::limit(  strip_tags( $chollo->titulo ), 20, ' ...' ) }}</h6></a>
            <div class="text-center mt-3 mb-3">
                @if($chollo->tipodescuento->id == 2)
                    <span style="font-size:120%;" class="font-weight-bold {{$chollo->activo ? 'text-primary' : 'text-secondary'}}">{{$chollo->descuento}}% de descuento</span>
                    @else
                    @if($chollo->precio_actual == 0 | $chollo->precio_actual == null)
                    <span style="font-size:120%;" class="font-weight-bold {{$chollo->activo ? 'text-primary' : 'text-secondary'}}">Gratis!</span>
                    @else
                    <span style="font-size:120%;" class="font-weight-bold {{$chollo->activo ? 'text-primary' : 'text-secondary'}}">{{$chollo->precio_actual}}€</span>
                    @endif
                    @if($chollo->precio_anterior)
                    <span class="text-secondary" style="text-decoration:line-through;">{{$chollo->precio_anterior}}€</span>
                    @endif 
                @endif          
            </div>
            <div class="meta-chollo d-flex justify-content-between">
                <p class="{{$chollo->activo ? 'fecha' : 'text-secondary'}} font-weight-bold">
                    {{ $chollo->created_at->diffForHumans() }}
                </p>

                <p>{{ count( $chollo->likes ) }} <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart-fill" color="{{$chollo->activo ? '#900B0B' : 'grey'}}" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                  </svg></p> 
            </div>
            <div class="borde-cupon rounded p-1 mb-2 text-center">
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
            <a href="{{$chollo->url}}"
                class="{{$chollo->activo ? 'btn-primary' : 'btn-secondary'}} btn d-block">Ir al chollo
            </a>
        </div>
    </div>
</div>