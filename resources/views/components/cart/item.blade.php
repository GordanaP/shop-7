<tr>
    <td>
        <x-product.image
            :image="$item->mainImage()"
            class="rounded-sm lg:w-4/5"
        />
    </td>

    <td width="35%">
        <p class="text-uppercase mb-2">
            <a href="{{ route('products.show', $item) }}"
            class="font-semibold tracking-wide text-teal-500">
                {{ $item->title }}
            </a>
        </p>
        <p class="text-xs text-gray-500">{{ $item->subtitle }}</p>
    </td>

    <td class="text-center">
        {{ $item->price }}
    </td>

    <td class="text-center" width="10%">
        <x-cart.update-qty :item="$item" />
    </td>

    <td class="text-right">
        {{ Str::withCurrency($item->subtotal_in_dollars) }}
    </td>

    <td class="text-right">
        <x-cart.remove-item
            :item="$item"
            :route="route('shopping.cart.remove', $item)"
            class="fa-lg"
        />
    </td>
</tr>