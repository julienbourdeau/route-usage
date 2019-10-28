<?php

return [

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

];
