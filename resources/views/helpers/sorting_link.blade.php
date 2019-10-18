<a href="{{ route('route-usage.index', [
    'orderBy' => $orderByAttribute,
    'sort' => 'asc',
]) }}">
    asc
</a>

<a href="{{ route('route-usage.index', [
    'orderBy' => $orderByAttribute,
    'sort' => 'desc',
]) }}">
    desc
</a>
