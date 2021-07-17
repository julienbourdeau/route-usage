<?php

namespace Julienbourdeau\RouteUsage\Listeners;

use Julienbourdeau\RouteUsage\RouteUsage;

class LogRouteUsage
{
    public function handle($event)
    {
        if (!$this->shouldLogUsage($event)) {
            return;
        }

        extract($this->extractAttributes($event));

        RouteUsage::updateOrCreate([
            'identifier' => $identifier,
        ], [
            'method' => $method,
            'path' => $path,
            'status_code' => $status_code,
            'action' => $action,
            'updated_at' => $date,
        ]);
    }

    protected function shouldLogUsage($event)
    {
        if ($event->request->isMethod('options')) {
            return false;
        }

        $status_code = $event->response->getStatusCode();
        if ($status_code >= 400 || $status_code < 200) {
            return false;
        }

        $route = $event->request->route();
        $regex = config('route-usage.excluding-regex');

        // $route is not set when using Dingo router
        // See https://github.com/julienbourdeau/route-usage/issues/22
        if (is_null($route)) {
            return true;
        }

        if (isset($regex['name']) && $regex['name'] && preg_match($regex['name'], $route->getName())) {
            return false;
        }

        if (isset($regex['uri']) && $regex['uri'] && preg_match($regex['uri'], $route->uri)) {
            return false;
        }

        return true;
    }

    protected function extractAttributes($event)
    {
        $path = ($route = $event->request->route()) ? $route->uri : $event->request->getPathInfo();
        $action = $route ? $route->getAction()['uses'] : null;

        if ($action instanceof \Closure) {
            $action = '[Closure]';
        } elseif (!is_string($action) && !is_null($action)) {
            $action = '[Unsupported]';
        }

        return [
            'status_code' => $status_code = $event->response->getStatusCode(),
            'method' => $method = $event->request->getMethod(),
            'path' => $path,
            'action' => $action,
            'identifier' => sha1($method.$path.$action.$status_code),
            'date' => date(config('route-usage.date-format', 'Y-m-d H:i:s')),
        ];
    }
}
