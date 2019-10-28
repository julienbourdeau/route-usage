<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'RouteUsageController@index')->name('route-usage.index');
