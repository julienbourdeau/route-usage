<?php

namespace Julienbourdeau\RouteUsage;

use Illuminate\Database\Eloquent\Model;

class RouteUsage extends Model
{
    protected $table = 'route_usage';

    protected $casts = [
        'updated_at' => 'datetime',
    ];
}
