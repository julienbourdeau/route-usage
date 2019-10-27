<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Exclude requests based on route name or uri
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'excluding-regex' => [
        'name' => '/^(route-usage\.|nova\.)/',
        'uri' => ''
    ],
];
