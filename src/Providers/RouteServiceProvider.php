<?php

namespace Medz\Fans\Providers;

use Illuminate\Support\Facades\Route;
use Dingo\Api\Routing\Router as DingoRouter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Medz\Fans\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->makeApiRouter();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        // $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));

        Route::prefix('old')
            ->middleware('phpwind9')
            ->group(base_path('routes/phpwind9.php'));
    }

    // /**
    //  * Define the "api" routes for the application.
    //  *
    //  * These routes are typically stateless.
    //  *
    //  * @return void
    //  */
    // protected function mapApiRoutes()
    // {
    //     Route::prefix('api')
    //          ->middleware('api')
    //          ->namespace('Medz\\Wind\\Http\\Api')
    //          ->group(base_path('routes/api.php'));
    // }

    /**
     * Make API Router.
     *
     * @return void
     * @author Seven Du <shiweidu@outlook.com>
     */
    protected function makeApiRouter()
    {
        $this->app->call(function (DingoRouter $api) {
            require base_path('routes/api.php');

            return $api;
        });
    }
}
