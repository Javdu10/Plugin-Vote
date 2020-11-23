<?php

namespace Azuriom\Plugin\Vote\Providers;

use Azuriom\Extensions\Plugin\BaseRouteServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends BaseRouteServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * @var string
     */
    protected $namespace = 'Azuriom\Plugin\Vote\Controllers';

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function loadRoutes()
    {
        $this->mapPluginsRoutes();

        $this->mapAdminRoutes();

        $this->mapApiRoutes();
    }

    protected function mapPluginsRoutes()
    {
        Route::prefix($this->plugin->id)
            ->middleware('web')
            ->namespace($this->namespace)
            ->name($this->plugin->id.'.')
            ->group(plugin_path($this->plugin->id.'/routes/web.php'));
    }

    protected function mapAdminRoutes()
    {
        Route::prefix('admin/'.$this->plugin->id)
            ->middleware('admin-access')
            ->namespace($this->namespace.'\Admin')
            ->name($this->plugin->id.'.admin.')
            ->group(plugin_path($this->plugin->id.'/routes/admin.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api/'.$this->plugin->id)
            ->middleware('api')
            ->namespace($this->namespace.'\Api')
            ->name($this->plugin->id.'.api.')
            ->group(plugin_path($this->plugin->id.'/routes/api.php'));
    }
}
