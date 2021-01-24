<?php

namespace App\Providers;

use View;
use App\Chollo;
use App\TiendaChollo;
use App\CategoriaChollo;
use Illuminate\Support\ServiceProvider;

class NavProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view) {

            $tiendas = TiendaChollo::all();
            $categorias = CategoriaChollo::all();
            $view->with('categorias', $categorias)->with('tiendas', $tiendas);
        });
    }
}
