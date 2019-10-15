<?php

namespace Julienbourdeau\RouteAccesses;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Julienbourdeau\RouteAccesses\Skeleton\SkeletonClass
 */
class RouteAccessesFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'route-accesses';
    }
}
