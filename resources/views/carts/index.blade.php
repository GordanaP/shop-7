<x-layouts.app>

    @section('links')
        <style>
            table.ordered-items tbody td.no-border { border-top: none; }
            table.ordered-items, table.ordered-items thead th,
            table.ordered-items tbody td {
                border-color:  #edf2f7 !important
            }

            .profile-usermenu a.active {
                color: #4fd1c5;
                font-weight: 500;
                background-color: #f8fafc;
                border-left: 2px solid #4fd1c5;
                border-bottom: 1px solid #f0f5fa;
                border-top: 1px solid #f0f5fa;
            }

            .profile-usermenu a {
                border-bottom: 1px solid #f0f5fa;
            }

            .profile-usermenu:hover {
                background-color: #fafcfd;
            }

        </style>
    @endsection

    <div class="my-4">
        <div class="mx-4">
            <x-alert.message />

            <div class="float-right mb-2">
                <x-product.go-shopping-btn :route="route('welcome')" />
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="mx-4 p-4 mt-1" style="background-color: #E9ECF3;">
            <div class="row">
                <div class="col-md-3">
                    @auth
                        <x-sidebar.customer-card
                            :customerName="Auth::user()->name"
                            :ordersIndexRoute="route('users.orders.index', Auth::user())"
                        />
                    @else
                        <x-sidebar.guest-card />
                    @endauth
                </div>
                <div class="col-md-9">
                    <div class="bg-white p-4 h-full">
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>