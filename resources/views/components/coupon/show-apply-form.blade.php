<tr>
    <td colspan="2"></td>

    <td class="text-right">
        <x-coupon.apply :route="route('coupons.store')" />
    </td>

    <x-cart.subtotal :subtotal="Str::withCurrency(ShoppingCart::subtotal())" />
</tr>