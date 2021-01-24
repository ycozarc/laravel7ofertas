<div class="pl-3 pb-3">
<div class="card" style="width: 500px;">
    <div class="row no-gutters">
        <div class="col-sm-5">
            <img class="card-img" src="/storage/{{ $chollo->imagen }}" alt="Imagen chollo" width="128" height="128">
        </div>
        <div class="col-sm-7">
            <div class="card-body">
                <h5 class="card-title">{{ Str::limit(  strip_tags( $chollo->titulo ), 20, ' ...' ) }}</h5>
                <p class="card-text">
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
                <div class="meta-chollo d-flex justify-content-between">
                    <p class="{{$chollo->activo ? 'fecha' : 'text-secondary'}} font-weight-bold">
                        {{ $chollo->created_at->diffForHumans() }}
                    </p>
    
                    <p>{{ count( $chollo->likes ) }} <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart-fill" color="{{$chollo->activo ? '#900B0B' : 'grey'}}" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                      </svg></p> 
                </div>
                </p>
                <a href="{{ route('chollos.show', ['chollo' => $chollo->id ])}}" class="{{$chollo->activo ? 'btn-primary' : 'btn-secondary'}} btn d-block">Ver chollo</a>
            </div>
        </div>
    </div>
</div>
</div>