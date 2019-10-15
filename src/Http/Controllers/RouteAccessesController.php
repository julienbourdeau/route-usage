<?php

namespace Julienbourdeau\RouteAccesses\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Julienbourdeau\RouteAccesses\RouteAccess;

class RouteAccessesController extends Controller
{
    public function index(Request $request)
    {
        $order = $request->get('orderBy') ?? 'updated_at';
        $sort = $request->get('sort') ?? 'asc';

        if (is_null($route = RouteAccess::first())) {
            return 'No route access logged yet.';
        }

        $attributes = array_keys($route->getAttributes());
        if (!in_array($order, $attributes)) {
            $order = 'updated_at';
        }
        if (!in_array($sort, ['asc', 'desc'])) {
            $sort = 'asc';
        }

        return view('route-accesses::index', [
            'routes' => RouteAccess::orderBy($order, $sort)->get(),
        ]);
    }
}
