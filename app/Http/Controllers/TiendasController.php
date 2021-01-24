<?php

namespace App\Http\Controllers;

use App\Chollo;
use App\TiendaChollo;
use Illuminate\Http\Request;

class TiendasController extends Controller
{
    public function show(TiendaChollo $tiendaChollo)
    {
        $chollos = Chollo::where('moderado', true)->where('tienda_id', $tiendaChollo->id)->latest()->paginate(16);

        return view('tiendas.ver')->with('chollos',$chollos)->with('tiendaNombre', $tiendaChollo->nombre);
    }
}
