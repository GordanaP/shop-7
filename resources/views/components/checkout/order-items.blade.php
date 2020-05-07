<table class="table checkout-cart-table mb-0">
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td width="30%" class="py-4">
                    <x-product.image
                        :image="$item->mainImage()"
                        class="rounded-sm lg:w-4/5"
                     />
                </td>
                <td class="py-4">
                    <p class="uppercase-semibold text-xs text-gray-700 mb-2">
                        <a href="{{ route('products.show', $item) }}"
                        class="font-semibold tracking-wide text-teal-400">
                            {{ $item->title }}
                        </a>
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ $item->subtitle }}
                    </p>
                </td>
                <td width="20%" class="py-4">
                    {{ $item->quantity }} x {{ Present::price($item->calculated_price_in_cents) }}
                </td>
                <td class="py-4 font-semibold text-teal-500">
                    {{ Present::price($item->subtotal_in_cents) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>