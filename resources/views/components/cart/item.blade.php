<tr>
    <td>
        <x-product.card.image
            :product="$item"
            class="rounded-sm w-full"
        />
    </td>

    <td width="35%">
        <p class="mb-1">
            <a href="{{ route('products.show', $item) }}"
            class="uppercase text-xs font-semibold hover:text-red-dark-h hover:no-underline">
                {{ $item->title }}
            </a>
        </p>
        <p class="text-xs text-gray-500">
                {{ $item->subtitle }}
        </p>
    </td>

    <td>
        @if (Request::route('order'))
            <x-product.card.price
                class="text-sm"
                :productIsBeingPromoted="$item->isCurrentlyBeingPromoted()"
                :regularPrice="Present::price($item->ordered->price_in_cents)"
                :promotionName="Present::promotionFullName($item)"
                :promotionalPrice="Present::price($item->ordered->promotional_price_in_cents)"
            />
        @else
            <x-product.card.price
                class="text-sm"
                :productIsBeingPromoted="$item->isCurrentlyBeingPromoted()"
                :regularPrice="Present::price($item->price_in_cents)"
                :promotionName="Present::promotionFullName($item)"
                :promotionalPrice="Present::price($item->promotional_price_in_cents)"
            />
        @endif
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
            {{ Present::price(
                    $item->ordered->promotional_price_in_cents ?? $item->ordered->price_in_cents
                    * $item->ordered->quantity
                )
            }}
        @else
            {{ Present::price($item->subtotal_in_cents) }}
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