<?php

namespace Julienbourdeau\RouteUsage;

use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Support\Facades\Event;
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
        Event::listen(RequestHandled::class, LogRouteUsage::class);

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'route-usage');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            // Registering package commands.
            $this->commands([
                UsageRouteCommand::class,
            ]);
        }
    }
}
