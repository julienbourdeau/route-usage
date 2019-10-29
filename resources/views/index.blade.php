<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Route Usage</title>

    <link href="https://unpkg.com/tailwindcss@1.1.3/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="font-sans leading-none text-grey-darkest antialiased bg-gray-100">
    <div class="container mx-auto my-20">
        <h1 class="mb-8 font-bold text-3xl">Route Usage</h1>
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4">ID
                        <div>@include('route-usage::helpers.sorting_link', ['orderByAttribute' => 'id'])</div>
                    </th>
                    <th class="px-6 pt-6 pb-4">Route <div>&nbsp;</div></th>
                    <th class="px-6 pt-6 pb-4">Method <div>&nbsp;</div></th>
                    <th class="px-6 pt-6 pb-4">Code
                        <div>@include('route-usage::helpers.sorting_link', ['orderByAttribute' => 'status_code'])</div>
                    </th>
                    <th class="px-6 pt-6 pb-4">Last used
                        <div>@include('route-usage::helpers.sorting_link', ['orderByAttribute' => 'updated_at'])</div>
                    </th>
                </tr>
                @forelse($routes as $route)
                <tr class="hover:bg-grey-lightest focus-within:bg-grey-lightest">
                    <td class="border-t">
                        <div class="px-6 py-4 flex items-center focus:text-indigo">
                            {{ $route->id }}
                        </div>
                    </td>
                    <td class="border-t">
                        <div class="px-6 py-4 flex flex-col leading-relaxed" tabindex="-1">
                            <strong>{{ $route->path }}</strong>
                            <small>{{ $route->action }}</small>
                        </div>
                    </td>
                    <td class="border-t">
                        <div class="px-6 py-4 flex items-center" tabindex="-1">
                            {{ $route->method }}
                        </div>
                    </td>
                    <td class="border-t w-px">
                        <div class="px-4 flex items-center" tabindex="-1">
                            {{ $route->status_code }}
                        </div>
                    </td>
                    <td class="border-t w-px">
                        <div class="px-4 flex items-center" tabindex="-1">
                            {{ $route->updated_at->diffForHumans() }}
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="border-t py-12 text-center" colspan="5">No routes found.</td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</body>

</html>
