<?php

namespace Julienbourdeau\RouteAccesses;

use Illuminate\Database\Eloquent\Model;

class RouteAccess extends Model
{
    protected $casts = [
        'updated_at' => 'datetime',
    ];
}
