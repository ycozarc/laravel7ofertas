<?php

namespace App\Http\Controllers;

use App\CategoriaChollo;
use App\Chollo;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function show(CategoriaChollo $categoriaChollo)
    {
        $chollos = Chollo::where('moderado', true)->where('categoria_id', $categoriaChollo->id)->latest()->paginate(16);

        return view('categorias.ver')->with('chollos',$chollos)->with('categoriaNombre', $categoriaChollo->nombre);
    }
}
