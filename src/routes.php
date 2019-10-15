<?php

use Julienbourdeau\RouteAccesses\Http\Controllers\RouteAccessesController;

Route::get('routes-accesses', [RouteAccessesController::class, 'index'])->name('routes-accesses.index');
