<?php

namespace Julienbourdeau\RouteUsage\Traits;

trait AuthorizesRequests
{
    /**
     * The callback that should be used to authenticate package users.
     *
     * @var \Closure
     */
    public static $authUsing;

    /**
     * Register the package authentication callback.
     *
     * @param  \Closure  $callback
     * @return static
     */
    public static function auth($callback)
    {
        static::$authUsing = $callback;

        return new static;
    }

    /**
     * Determine if the given request can access the package dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public static function check($request)
    {
        return (static::$authUsing ?: function () {
            return app()->environment(config('route-usage.allowed_environments'));
        })($request);
    }
}
