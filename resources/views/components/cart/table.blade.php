<table class="table border mb-2 text-gray-600 ordered-items">
    <thead>
        <th width="12%">Item</th>
        <th width="25%"></th>
        <th width="25%">Price</th>
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
                    :subtotal="Present::price(ShoppingCart::subtotalInCents())"
                    :colspan="4"
                    class="pb-0"
                />
            </tr>

            <x-coupon.set-discount
                :discount="ShoppingCart::coupon()['discount']"
            />

            <x-coupon.show-discount
                :couponName="ShoppingCart::coupon()['name']"
                :discount="Present::price(ShoppingCart::getDiscountInCents())"
                :removeRoute="route('coupons.destroy')"
            />
        @endif

        <x-cart.prices
            :taxRate="Present::taxRate()"
            :taxAmount="Present::price(ShoppingCart::taxAmountInCents())"
            :shippingCosts="Present::price(ShoppingCart::shippingCostsInCents())"
            :grandTotal="Present::price(ShoppingCart::totalInCents())"
        />
    </tbody>
</table>

<div class="float-right mb-2">
    <x-cart.empty :route="route('shopping.cart.empty')" />

    <a href="{{ route('checkouts.index') }}" class="btn
     text-white rounded-full bg-red-dark hover:bg-red-dark-h">
        Proceed to checkout
    </a>
</div>