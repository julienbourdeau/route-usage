<a class="text-sm text-gray-600 font-normal" href="{{ route('route-usage.index', [
    'orderBy' => $orderByAttribute,
    'sort' => 'asc',
]) }}">
    asc
</a>

<a class="text-sm text-gray-600 font-normal" href="{{ route('route-usage.index', [
    'orderBy' => $orderByAttribute,
    'sort' => 'desc',
]) }}">
    desc
</a>
