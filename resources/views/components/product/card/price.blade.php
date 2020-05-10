<p class="mb-2 text-lg">
    @if ($productIsBeingPromoted)
        <span class="line-through font-semibold mr-2">
            {{ $regularPrice }}
        </span>
        <span class="text-teal-400 font-semibold">
            {{ $promotionalPrice }}
        </span>
    @else
        <span class="font-semibold mr-2">
            {{ $regularPrice }}
        </span>
    @endif
</p>

{{-- @if ($productIsBeingPromoted)
    <div class="flex flex-col items-start">
        <p>
            <span class="line-through mr-2">
                {{ $regularPrice }}
            </span>
            <span class="text-gray-600">{{ $promotionName ?? null }}</span>
        </p>
        <p class="text-teal-400 font-semibold">
            {{ $promotionalPrice }}
        </p>
    </div>
@else
    {{ $regularPrice }}</span>
@endif --}}