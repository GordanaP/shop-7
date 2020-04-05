<tr>
    <td>
        <img class="img-fluid rounded w-4/5 mt-2"
        src="{{ asset('images/demo_product.jpg') }}"
        alt="Item image">
    </td>
    <td width="35%">
        <p class="text-uppercase mb-2">
            <a href="{{ route('products.show', $item) }}"
            class="font-semibold tracking-wide">
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
        <x-cart.remove-item :item="$item" />
    </td>
</tr>