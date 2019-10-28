<?php

use Julienbourdeau\RouteUsage\Http\Middleware\Authorize;

return [

    /*
    |--------------------------------------------------------------------------
    | Route Usage Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where this package will be accessible from.
    | Feel free to change this path to anything you like.
    |
    */
    'path' => env('ROUTE_USAGE_PATH', 'route-usage'),

    /*
    |--------------------------------------------------------------------------
    | Exclude requests based on route name or uri
    |--------------------------------------------------------------------------
    |
    | Here you may specify regex to exclude routes from being logged. Typically,
    | you want may want to exclude routes from packages or dev controllers.
    |
    | The value must be a valid regex or anything falsy.
    |
    */

    'excluding-regex' => [
        'name' => '/^(route-usage|nova|debugbar|horizon)\./',
        'uri' => ''
    ],

    /*
    |--------------------------------------------------------------------------
    | Environment
    |--------------------------------------------------------------------------
    |
    | If you don't want to use this package in production env
    | at all, you can restrict that using this option
    | rather than by using a middleware.
    |
    */

    'allowed_environments' => ['local', 'staging', 'testing'],

    /*
    |--------------------------------------------------------------------------
    | Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to this package routes, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */
    'middleware' => [
        'web',
        Authorize::class,
    ],
];
