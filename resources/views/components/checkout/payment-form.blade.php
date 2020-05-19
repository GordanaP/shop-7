<div class="border border-gray-400 px-4 pb-4 pt-8">
    <form id="paymentForm" action="{{ $route }}" method="POST">

        @csrf

        <p class="uppercase-semibold text-gray-700 mb-2">
            Billing & Shipping Information
        </p>
        @auth
            <div class="row mb-6">
                <div class="col-md-6">
                    <x-checkout.auth.address
                        :link="route('users.customers.edit',
                            [Auth::user(), Auth::user()->customer])"
                        :address="Auth::user()->customer"
                    />
                </div>
                <div class="col-md-6">
                    <x-checkout.auth.address
                        class="h-full"
                        :link="route('users.shippings.index',
                            [Auth::user()] + ['select' => true])"
                        :address="Auth::user()->shippingOnCheckout()"
                    />
                </div>
            </div>
        @endauth

        @guest
            <x-checkout.guest-info />
        @endguest

        <div id="paymentInfo">
            <p class="uppercase-semibold text-gray-700 mb-2">
                Payment Information
            </p>

            <x-checkout.stripe-elem
                :total="Present::price(ShoppingCart::totalInCents())"
            />
        </div>
    </form>
</div>