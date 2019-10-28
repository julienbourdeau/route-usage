<?php

namespace Julienbourdeau\RouteUsage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Julienbourdeau\RouteUsage\RouteUsage;

class RouteUsageController extends Controller
{
    public function index(Request $request)
    {
        $order = $request->get('orderBy', 'updated_at');
        $sort = $request->get('sort', 'asc');

        if (is_null($route = RouteUsage::first())) {
            return view('route-usage::index', ['routes' => []]);
        }

        $attributes = array_keys($route->getAttributes());
        if (!in_array($order, $attributes)) {
            $order = 'updated_at';
        }
        if (!in_array($sort, ['asc', 'desc'])) {
            $sort = 'asc';
        }

        return view('route-usage::index', [
            'routes' => RouteUsage::orderBy($order, $sort)->get(),
        ]);
    }
}
