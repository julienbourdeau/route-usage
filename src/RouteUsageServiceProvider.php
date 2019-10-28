<?php

namespace Julienbourdeau\RouteUsage;

use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Julienbourdeau\RouteUsage\Console\Commands\UsageRouteCommand;
use Julienbourdeau\RouteUsage\Listeners\LogRouteUsage;

class RouteUsageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if (app()->environment(config('route-usage.allowed_environments'))) {
            Event::listen(RequestHandled::class, LogRouteUsage::class);
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'route-usage');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('route-usage.php'),
            ], 'config');

            $this->commands([
                UsageRouteCommand::class,
            ]);
        }

        $this->registerRoutes();
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/routes.php');
        });
    }

    /**
     * Get the package route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            'namespace' => 'Julienbourdeau\RouteUsage\Http\Controllers',
            'prefix' => config('route-usage.path'),
            'middleware' => config('route-usage.middleware'),
        ];
    }
}
