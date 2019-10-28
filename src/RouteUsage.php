<?php

namespace Julienbourdeau\RouteUsage;

use Illuminate\Database\Eloquent\Model;
use Julienbourdeau\RouteUsage\Traits\AuthorizesRequests;

class RouteUsage extends Model
{
    use AuthorizesRequests;

    protected $table = 'route_usage';

    protected static $unguarded = true;

    protected $casts = [
        'updated_at' => 'datetime',
    ];
}
