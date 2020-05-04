<tr {{ $attributes->merge(['class' => 'price']) }}>

    <td colspan="4" {{ $attributes->merge(['class' => 'text-right']) }}>

        {{ $title }}

        @if (isset($taxRate))
            ({{ $taxRate }}%)
        @endif
    </td>

    <td {{ $attributes->merge(['class' => 'text-right']) }}>
        @if (isset($discount))
            <p class="mt-0" ">-{{ $discount }}</p>
        @else
            {{ Str::price(number_format($priceInCents / 100, 2)) }}
        @endif
    </td>
</tr>
