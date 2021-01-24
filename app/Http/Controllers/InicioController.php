<?php

namespace App\Http\Controllers;

use App\Chollo;
use App\CategoriaChollo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    //
    public function index()
    {
        $maspopulares = Chollo::where('moderado', true)->withCount('likes')->orderBy('likes_count', 'desc')->take(4)->get();

        $ultimoschollos = Chollo::latest()->where('moderado', true)->limit(4)->get();

        $categorias = CategoriaChollo::all();

        $chollos = [];

        foreach($categorias as $categoria){
            $chollos[Str::slug($categoria->nombre . "separador" . $categoria->id)][] = Chollo::where('categoria_id', $categoria->id)->where('moderado', true)->limit(4)->latest()->get();
        }

        return view('inicio.index')->with('ultimoschollos', $ultimoschollos)->with('chollos', $chollos)->with('maspopulares', $maspopulares);
    }
}
