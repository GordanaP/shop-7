<p class="mb-2 text-lg">
    @if ($productIsBeingPromoted)
        <span class="line-through font-semibold mr-2 {{ $class ?? null }}">
            {{ $regularPrice }}
        </span>
        <span class="font-semibold text-petroleum {{ $class ?? null }}">
            {{ $promotionalPrice }}
        </span>
    @else
        <span class="font-semibold mr-2 {{ $class ?? null }}">
            {{ $regularPrice }}
        </span>
    @endif
</p>
