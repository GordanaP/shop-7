<table class="table checkout-cart-table mb-0">
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td width="30%" class="py-4">
                    <x-product.card.image
                        :product="$item"
                        class="rounded-sm lg:w-4/5"
                     />
                </td>
                <td width="35%" class="py-4">
                    <p class="uppercase-semibold text-xs mb-2">
                        <a href="{{ route('products.show', $item) }}"
                        class="uppercase-semibold hover:no-underline">
                            {{ $item->title }}
                        </a>
                    </p>
                    <p class="text-xs text-gray-600">
                        {{ $item->subtitle }}
                    </p>
                </td>
                <td width="10%" class="py-4">
                    {{ $item->quantity }}
                </td>
                <td width="10%" class="py-4">x</td>
                <td class="py-4">
                    <x-product.card.price
                        class="text-sm"
                        :productIsBeingPromoted="$item->isCurrentlyBeingPromoted()"
                        :regularPrice="Present::price($item->price_in_cents)"
                        :promotionalPrice="Present::price($item->promotional_price_in_cents)"
                    />
                </td>
                <td class="py-4 font-semibold text-teal-500">
                    {{ Present::price($item->subtotal_in_cents) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>