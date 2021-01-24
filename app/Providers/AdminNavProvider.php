<?php

namespace App\Providers;

use App\Chollo;
use Illuminate\Support\ServiceProvider;
use View;
class AdminNavProvider extends ServiceProvider
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

            $pendientes = Chollo::where('moderado',false)->count();
            $view->with('pendientes', $pendientes);
        });
    }
}
