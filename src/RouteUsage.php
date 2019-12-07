<?php

namespace Julienbourdeau\RouteUsage;

use Illuminate\Database\Eloquent\Model;

class RouteUsage extends Model
{
    protected $table = 'route_usage';

    protected static $unguarded = true;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
