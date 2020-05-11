<tr>
    <td>
        <img src="{{ $item->pdfImage() }}" width="90%">
    </td>
    <td>
        <p class="w-80 mt-0 mb-1 font-12 uppercase-semibold text-xs
        text-red-dark hover:no_underline hover:text-red-dark-h">
            {{ $item->title }}
        </p>
        <p class="font-14 w-80">
            {{ $item->subtitle }}
        </p>
    </td>
    <td>
        @if ($item->isCurrentlyBeingPromoted())
            <p class="mt-0 mb-1">
                <span class="line-through mr-2">
                    {{ Present::price($item->ordered->price_in_cents) }}
                </span>
                <span class="text-gray-600">
                    {{ Present::promotionFullName($item) }}
                </span>
            </p>
            <p class="mt-0">{{ Present::price($item->ordered->promotional_price_in_cents) }}</p>
        @else
            <p class="mt-0">
                {{ Present::price($item->ordered->price_in_cents) }}
            </p>
        @endif
    </td>
    <td class="text-center">{{ $item->ordered->quantity }}</td>
    <td class="text-right">
        {{
            Present::price(
                $item->ordered->promotional_price_in_cents ?? $item->ordered->price_in_cents
                * $item->ordered->quantity
            )
        }}
    </td>
</tr>