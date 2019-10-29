<?php

namespace Julienbourdeau\RouteUsage;

use Illuminate\Foundation\Http\Events\RequestHandled;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
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
        $this->listen();

        $this->gate();

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'route-usage');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('route-usage.php'),
            ], 'config');

            $this->commands([
                UsageRouteCommand::class,
            ]);
        }
    }

    protected function gate()
    {
        Gate::define('viewRouteUsage', function ($user) {
            return false;
        });
    }

    protected function listen()
    {
        Event::listen(RequestHandled::class, LogRouteUsage::class);
    }
}
