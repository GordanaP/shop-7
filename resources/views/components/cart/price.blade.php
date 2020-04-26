<tr>
    <td colspan="4" class="text-right">
        @if (Session::has('coupon'))
            <p class="font-bold">Subtotal</p>
            <p>Discount:</p>
        @endif
        <p>Shipping & Handling:</p>
        <p>Tax ({{ config('cart.tax_rate') * 100 }}%):</p>
        <p class="uppercase font-bold mt-1">Grand Total:</p>
    </td>

    <td class="text-right">
        @if (Session::has('coupon'))
            <p class="font-bold">
                {{ Str::withCurrency(ShoppingCart::subtotalWithoutDiscount()/100) }}
            </p>
            <p>
                -${{ collect(Session::get('coupon'))->get('discount') /100 }}
            </p>
        @endif
        <p>
            {{ Str::withCurrency(ShoppingCart::shippingCosts()) }}
        </p>
        <p>
            {{ Str::withCurrency(ShoppingCart::taxAmount()) }}
        </p>
        <p class="font-bold mt-1">
            {{ Str::withCurrency(ShoppingCart::total()) }}
        </p>
    </td>

    <td></td>
</tr>