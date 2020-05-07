<tr>
    <td>
        <x-product.image
            :image="$item->mainImage()"
            class="rounded-sm w-full"
        />
    </td>

    <td width="35%">
        <p class="mb-2">
            <a href="{{ route('products.show', $item) }}"
            class="uppercase text-xs font-semibold text-teal-500">
                {{ $item->title }}
            </a>
        </p>
        <p class="text-xs text-gray-500">
                {{ $item->subtitle }}
        </p>
    </td>

    <td class="text-center">
        {{ Request::route('order')
            ? $item->orderPrice($item->ordered->price_in_cents)
            : Str::price(number_format($item->calculated_price_in_cents / 100, 2)) }}
    </td>

    <td class="text-center" width="10%">
        @if (Request::route('order'))
            {{ $item->ordered->quantity }}
        @else
            <x-cart.update-qty
                :item="$item"
                :route="route('shopping.cart.update', $item)"
            />
        @endif
    </td>

    <td class="text-right">
        @if (Request::route('order'))
            {{ $item->orderSubtotal($item->ordered->price_in_cents, $item->ordered->quantity) }}
        @else
            {{ Str::withCurrency($item->subtotal_in_dollars) }}
        @endif
    </td>

    <td class="text-right">
        @if(! Request::route('order'))
            <x-cart.remove-item
                :item="$item"
                :route="route('shopping.cart.remove', $item)"
                class="fa-lg"
            />
        @endif
    </td>
</tr>