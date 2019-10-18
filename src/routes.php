<?php

use Julienbourdeau\RouteUsage\Http\Controllers\RouteUsageController;

Route::get('route-usage', [RouteUsageController::class, 'index'])->name('route-usage.index');
