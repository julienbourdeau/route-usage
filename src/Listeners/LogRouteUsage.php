<?php

namespace Julienbourdeau\RouteUsage\Listeners;

use Illuminate\Support\Facades\DB;

class LogRouteUsage
{
    public function handle($event)
    {
        $status_code = $event->response->getStatusCode();

        if ($status_code > 300 || $status_code < 200) {
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
        $date = date('Y-m-d H:i:s');

        DB::statement(
            "INSERT INTO route_usage
                    (`identifier`, `method`, `path`, `status_code`, `action`, `created_at`, `updated_at`)
                VALUES (?, ?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE `updated_at` = '$date'",
            [$identifier, $method, $path, $status_code, $action, $date, $date]
        );
    }
}
