<td
    {{ $attributes->merge(['class' => 'text-right font-bold']) }}
    @if(isset($colspane))
        colspan="{{ $colspan }}"
    @endif
>
    Subtotal
</td>

<td class="text-right font-bold">
    {{ $subtotal }}
</td>

<td class="pt-2 pb-1"></td>
