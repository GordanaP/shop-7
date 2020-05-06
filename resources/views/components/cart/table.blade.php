<table class="table border mb-2 text-gray-600 ordered-items">
    <thead>
        <th width="12%">Item</th>
        <th width="25%"></th>
        <th class="text-center" width="25%">Price</th>
        <th class="text-center" width="15%">Qty</th>
        <th class="text-right" width="15%">Subtotal</th>
        <th></th>
    </thead>

    <tbody>
        @foreach (ShoppingCart::content() as $item)
            <x-cart.item :item="$item" />
        @endforeach

        @if (! ShoppingCart::has('coupon'))
            <x-coupon.show-apply-form class="pt-2 pb-0" />
        @endif

        @if (ShoppingCart::has('coupon'))
            <tr>
                <x-cart.subtotal
                    :subtotal="Str::withCurrency(ShoppingCart::subtotal())"
                    :colspan="4"
                    class="pb-0"
                />
            </tr>

            <x-coupon.set-discount
                :discount="ShoppingCart::coupon()['discount']"
            />

            <x-coupon.show-discount
                :couponValue="ShoppingCart::coupon()['value']"
                :discount="Str::withCurrency(number_format(ShoppingCart::getDiscount(), 2))"
                :removeRoute="route('coupons.destroy')"
            />
        @endif

        <x-cart.prices
            :taxRate="config('cart.tax_rate') * 100"
            :taxAmount="Str::withCurrency(ShoppingCart::taxAmount())"
            :shippingCosts="Str::withCurrency(ShoppingCart::shippingCosts())"
            :grandTotal="Str::withCurrency(ShoppingCart::total())"
        />
    </tbody>
</table>

<div class="float-right mb-2">
    <x-cart.empty :route="route('shopping.cart.empty')" />

    <a href="{{ route('checkouts.index') }}" class="btn
    bg-teal-400 hover:bg-teal-500 text-white rounded-full">
        Proceed to checkout
    </a>
</div>