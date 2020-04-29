<tr>
    <td colspan="4" class="text-right py-0 no-border">
        <p>Discount:</p>
        <p class="text-xs mb-1 text-gray-600">
            {{ $couponValue }}
        </p>
    </td>
    <td class="text-right py-0 no-border">
        <p>
            -{{  Str::withCurrency(number_format(ShoppingCart::getDiscount(), 2)) }}
        </p>

        <x-coupon.remove :route="route('coupons.destroy')" />
    </td>
    <td class=" py-0 no-border"></td>
</tr>