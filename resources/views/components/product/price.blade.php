@if ($productIsBeingPromoted)
    <span class="line-through">
        {{ $regularPrice }}
    </span>
    <p class="text-teal-400 font-semibold">
        {{ $promotionalPrice }}
    </p>
@else
    {{ $regularPrice }}</span>
@endif