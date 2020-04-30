<x-layouts.app>

    @section('links')
        <style>
            table.ordered-items tbody td.no-border { border-top: none; }
        </style>
    @endsection

    <div class="container my-4">
        <x-alert.message />

        <div class="float-right mb-2">
            <x-product.go-shopping-btn :route="route('welcome')" />
        </div>

        <div class="clearfix"></div>

        <div class="row bg-white p-4">
            <div class="col-md-3">
                <div class="text-center text-2xl py-16 px-4">
                    <i class="fa fa-shopping-basket fa-4x text-teal-400"
                    aria-hidden="true"></i>

                    <h4 class="text-2xl font-semibold mt-4">
                        My cart
                    </h4>
                </div>
            </div>
            <div class="col-md-9">
                @if (ShoppingCart::isNotEmpty())
                    <table class="table border mb-2 ordered-items">
                        <thead>
                            <th width="12%">Item</th>
                            <th width="25%"></th>
                            <th class="text-center" width="25%">Price</th>
                            <th class="text-center" width="15%">Qty</th>
                            <th class="text-right" width="15%">Subtotal</th>
                            <th class="text-right"><i class="fa-fa-cog"></i></th>
                        </thead>

                        <tbody>
                            @foreach ($items as $item)
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
                @else
                    <h2 class="text-center mb-4">Your cart is empty at present.</h2>
                    <div class="text-center">
                        <x-product.go-shopping-btn :route="route('welcome')" />
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-layouts.app>