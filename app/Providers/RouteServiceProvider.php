<?php

namespace App\Providers;

use App\App;
use App\Counter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     * In addition, it is set as the URL generator's root namespace.
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::bind('app', function (string $value) {
            return (new App)->newQuery()->where('uuid', $value)->first() ?? abort(404);
        });

        Route::bind('counter', function (string $value) {
            return (new Counter)->newQuery()->where('name', $value)->first() ?? abort(404);
        });
    }

    /**
     * Define the routes for the application.
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     * These routes all receive session state, CSRF protection, etc.
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group($this->app->basePath('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     * These routes are typically stateless.
     * @return void
     */
    protected function mapApiRoutes()
    {
        $version = config('canary.api_version');

        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group($this->app->basePath("routes/api-$version.php"));
    }
}
