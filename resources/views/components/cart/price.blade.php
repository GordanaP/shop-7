<tr>
    <td colspan="4" class="text-right">
        <p class="font-bold">Subtotal:</p>
        <p>Shipping & Handling:</p>
        <p>Tax ({{ config('cart.tax_rate') * 100 }}%):</p>
        <p class="uppercase font-bold mt-1">Grand Total:</p>
    </td>

    <td class="text-right">
        <p class="font-bold">
            {{ Str::withCurrency(ShoppingCart::subtotal()) }}
        </p>
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