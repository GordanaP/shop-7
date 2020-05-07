<tr class="price">
    <td colspan="4" class="text-right py-0 no-border">
        <p>Discount:</p>
        <p class="text-xs mb-1 text-gray-600">
            {{ $couponValue }}
        </p>
    </td>
    <td class="text-right py-0 no-border">
        <p>-{{  $discount }}</p>

        @if (! Request::route('order'))
            <p class="text-xs text-teal-500">
                <a href="{{ $removeRoute }}">Remove</a>
            </p>
        @endif
    </td>
    <td class=" py-0 no-border"></td>
</tr>