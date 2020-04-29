<tr>
    <td colspan="2"></td>

    <td class="text-right bg-gray-200 px-4 ">
        <x-coupon.apply :route="route('coupons.store')" />
    </td>

    <td class="text-right font-bold">
        Subtotal:
    </td>

    <td class="text-right font-bold">
        {{ Str::withCurrency(ShoppingCart::subtotal()) }}
    </td>

    <td></td>
</tr>