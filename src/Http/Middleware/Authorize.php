<?php

namespace Julienbourdeau\RouteUsage\Http\Middleware;

use Julienbourdeau\RouteUsage\RouteUsage;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return RouteUsage::check($request) ? $next($request) : abort(403);
    }
}
