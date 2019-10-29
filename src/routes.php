<?php

use Julienbourdeau\RouteUsage\Http\Controllers\RouteUsageController;

Route::get('route-usage', [RouteUsageController::class, 'index'])
    ->middleware(['web', \Julienbourdeau\RouteUsage\Authorize::class])
    ->name('route-usage.index');
