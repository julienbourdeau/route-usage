<?php

namespace Julienbourdeau\RouteAccesses;

use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Julienbourdeau\RouteAccesses\Listeners\LogRouteAccess;

class RouteAccessesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        Event::listen(RequestHandled::class, LogRouteAccess::class);

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'route-accesses');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }
}
