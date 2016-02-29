<?php

namespace NineCells\SimpleBoard;

use App;
use Illuminate\Support\ServiceProvider;
use NineCells\Auth\AuthServiceProvider;
use Mews\Purifier\PurifierServiceProvider;

class TilServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__ . '/Http/routes.php';
        }

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'ncells');

        $this->publishes([
            __DIR__ . '/database/migrations/' => database_path('migrations')
        ], 'migrations');
    }

    public function register()
    {
        App::register(AuthServiceProvider::class);
        App::register(PurifierServiceProvider::class);
    }
}
