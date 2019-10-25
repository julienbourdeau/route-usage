<?php

namespace Julienbourdeau\RouteUsage\Listeners;

use Illuminate\Support\Facades\DB;
use Julienbourdeau\RouteUsage\RouteUsage;

class LogRouteUsage
{
    public function handle($event)
    {
        $status_code = $event->response->getStatusCode();

        if ($status_code >= 400 || $status_code < 200) {
            return;
        }

        $method = $event->request->getMethod();
        $path = $event->request->route()->uri ?? $event->request->getPathInfo();
        $action = optional($event->request->route())->getAction()['uses'];

        if ($action instanceof \Closure) {
            $action = '[Closure]';
        } elseif (!is_string($action) && !is_null($action)) {
            $action = '[Unsupported]';
        }

        $identifier = sha1($method.$path.$action.$status_code);
        $date = now();

        RouteUsage::updateOrCreate([
            'identifier' => $identifier
        ], [
            'method' => $method,
            'path' => $path,
            'status_code' => $status_code,
            'action' => $action,
            'updated_at' => $date
        ]);
    }
}
