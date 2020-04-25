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
                        <th class="text-center" width="25%">Price</th>
                        <th class="text-center" width="15%">Qty</th>
                        <th class="text-right" width="15%">Subtotal</th>
                        <th class="text-right"><i class="fa-fa-cog"></i></th>
                    </thead>

                    <tbody>
                        @foreach ($items as $item)
                            <x-cart.item :item="$item" />
                        @endforeach

                        <tr>
                            <td colspan="2"></td>
                            <td class="text-right bg-gray-200 px-4 ">
                                <x-coupon.add />
                            </td>
                            <td class="text-right">
                                <p class="font-bold">Subtotal:</p>
                            </td>
                            <td class="text-right">
                                <p class="font-bold">
                                    {{ Str::withCurrency(ShoppingCart::subtotal()) }}
                                </p>
                            </td>
                            <td></td>
                        </tr>

                        <x-cart.price />

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