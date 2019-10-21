<?php

namespace Julienbourdeau\RouteUsage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Julienbourdeau\RouteUsage\RouteUsage;

class RouteUsageController extends Controller
{
    public function index(Request $request)
    {
        if (is_null($route = RouteUsage::first())) {
            return 'No route access logged yet.';
        }

        $order = $request->input('orderBy', 'updated_at');

        if (!in_array($order, array_keys($route->getAttributes()))) {
            $order = 'updated_at';
        }

        return view('route-usage::index', [
            'routes' => RouteUsage::orderBy($order, $request->input('sort', 'asc'))->get(),
        ]);
    }
}
