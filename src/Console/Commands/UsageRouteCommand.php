<?php

namespace Julienbourdeau\RouteUsage\Console\Commands;

use Illuminate\Foundation\Console\RouteListCommand;
use Julienbourdeau\RouteUsage\RouteUsage;

class UsageRouteCommand extends RouteListCommand
{
    protected $name = 'usage:route';

    protected $description = 'Show route list with the last access datetime';

    protected $headers = ['Domain', 'Method', 'URI', 'Last used', 'Name', 'Action', 'Middleware'];

    protected $compactColumns = ['method', 'uri', 'last used', 'action'];

    protected function getRoutes()
    {
        $routes = $this->splitRoutesByMethods(parent::getRoutes());

        // TODO: sort by updated_at and group by method+path
        $routeUsage = RouteUsage::all()->mapWithKeys(function ($r) {
            $key = $r->method.'.'.$r->path;

            return [$key => $r];
        });

        return $routes->map(function ($route) use ($routeUsage) {
            $usageKey = $route['method'].'.'.$route['uri'];
            $lastUsed = $routeUsage->has($usageKey) ?
                $routeUsage->get($usageKey)->updated_at->diffForHumans()
                : 'Never';

            return $this->option('compact') ?
                [
                    'method' => $route['method'],
                    'uri' => $route['uri'],
                    'last used' => $lastUsed,
                    'action' => $route['action'],
                ] : [
                    'domain' => $route['domain'],
                    'method' => $route['method'],
                    'uri' => $route['uri'],
                    'last used' => $lastUsed,
                    'name' => $route['name'],
                    'action' => $route['action'],
                    'middleware' => $route['middleware'],
                ];
        })->toArray();
    }

    protected function splitRoutesByMethods(array $routes)
    {
        return collect($routes)->transform(function ($r) {
            $splitRoutes = [];
            foreach (explode('|', $r['method']) as $m) {
                $r['method'] = $m;
                $splitRoutes[] = $r;
            }

            return $splitRoutes;
        })->flatten(1)->reject(function ($r) {
            return 'HEAD' === $r['method'];
        })->values();
    }
}
