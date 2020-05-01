<a href="{{ $route ?? null }}"
    class="list-group-item list-group-item-action text-gray-600 py-2
    {{ Request::is($request ?? null) ? 'active' : '' }}"
>

    {{ $title }}

</a>
