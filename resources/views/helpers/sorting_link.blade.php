<a href="{{ route('routes-accesses.index', [
    'orderBy' => $orderByAttribute,
    'sort' => 'asc',
]) }}">
    asc
</a>

<a href="{{ route('routes-accesses.index', [
    'orderBy' => $orderByAttribute,
    'sort' => 'desc',
]) }}">
    desc
</a>
