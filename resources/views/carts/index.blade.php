<x-layouts.app>

    <div class="my-4">
        <x-alert.message />

        @if (ShoppingCart::isNotEmpty())
            <div class="float-right mb-2">
                <x-product.go-shopping-btn
                    :route="route('welcome')"
                />
            </div>

            <div class="clearfix"></div>

            <div class="bg-white p-4 border mb-2">
                <table class="table border mb-0 ordered-items">
                    <thead>
                        <th width="15%">Item</th>
                        <th width="25%"></th>
                        <th class="text-center" width="20%">Price</th>
                        <th class="text-center" width="15%">Qty</th>
                        <th class="text-right" width="15%">Subtotal</th>
                        <th class="text-right"><i class="fa-fa-cog"></i></th>
                    </thead>

                    <tbody>
                        @foreach ($items as $item)
                            <x-cart.item :item="$item" />
                        @endforeach

                        @if (! ShoppingCart::has('coupon'))
                            <x-coupon.show />
                        @endif

                        <tr>
                            <td colspan="4" class="text-right">
                                @if (ShoppingCart::has('coupon'))
                                    <p class="font-bold mb-1">Subtotal</p>
                                    <p>Discount:</p>
                                    <p class="text-xs mb-1 text-gray-600">
                                        {{ ShoppingCart::coupon()['value'] }}
                                    </p>
                                @endif
                                <p class="mb-1">Tax ({{ config('cart.tax_rate') * 100 }}%):</p>
                                <p class="mb-2">Shipping & Handling:</p>
                                <p class="uppercase font-bold">Grand Total:</p>
                            </td>

                            <td class="text-right">
                                @if (ShoppingCart::has('coupon'))
                                    <p class="font-bold mb-1">
                                        {{ Str::withCurrency(ShoppingCart::subtotal()) }}
                                    </p>
                                    {{ ShoppingCart::setDiscount(ShoppingCart::coupon()['discount']) }}
                                    <p>
                                        -{{  Str::withCurrency(number_format(ShoppingCart::getDiscount(), 2)) }}
                                    </p>

                                    <x-coupon.remove :route="route('coupons.destroy')" />
                                @endif
                                <p class="mb-1">
                                    {{ Str::withCurrency(ShoppingCart::taxAmount()) }}
                                </p>
                                <p class="mb-2">
                                    {{ Str::withCurrency(ShoppingCart::shippingCosts()) }}
                                </p>
                                <p class="font-bold">
                                    {{ Str::withCurrency(ShoppingCart::total()) }}
                                </p>
                            </td>

                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="float-right mb-2">
                <x-cart.empty
                    :route="route('shopping.cart.empty')"
                />
                <a href="{{ route('checkouts.index') }}" class="btn
                bg-teal-400 hover:bg-teal-500 text-white rounded-full">
                    Proceed to checkout
                </a>
            </div>
        @else
            <h2 class="text-center mb-4">Your cart is empty at present.</h2>
            <div class="text-center">
                <x-product.go-shopping-btn
                    :route="route('welcome')"
                />
            </div>
        @endif
    </div>

</x-layouts.app>