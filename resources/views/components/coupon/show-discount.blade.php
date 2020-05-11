<tr class="price">
    <td colspan="4" class="text-right py-0 no-border">
        <p>Discount:</p>
        <p class="text-xs mb-1 text-gray-600">
            {{ $couponName }}
        </p>
    </td>
    <td class="text-right py-0 no-border">
        <p>{{  Present::discount($discount) }}</p>

        @if (! Request::route('order'))
            <p class="text-xs text-teal-500">
                <a href="{{ $removeRoute }}" class="text-petroleum
                hover:text-red-dark-h hover:no-underline">
                    Remove
                </a>
            </p>
        @endif
    </td>
    <td class=" py-0 no-border"></td>
</tr>