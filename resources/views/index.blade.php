<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body>
<h1>Route accesses</h1>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID @include('route-accesses::helpers.sorting_link', ['orderByAttribute' => 'id'])</th>
            <th>Route</th>
            <th>Code @include('route-accesses::helpers.sorting_link', ['orderByAttribute' => 'status_code'])</th>
            <th>Last used @include('route-accesses::helpers.sorting_link', ['orderByAttribute' => 'updated_at'])</th>
        </tr>
    </thead>
    <tbody>
        @foreach($routes as $route)
        <tr>
            <td>
                {{ $route->id }}
            </td>
            <td>
                <strong>{{ $route->path }}</strong><br>
                {{ $route->action }}
            </td>
            <td style="text-align:center">{{ $route->status_code }}</td>
            <td>{{ $route->updated_at->diffForHumans() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
