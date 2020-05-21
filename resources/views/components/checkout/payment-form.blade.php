<p class="text-center instruction px-2 absolute">Complete your details below</p>

<div class="border border-gray-400 px-4 pb-4 pt-8">
    <form id="paymentForm" action="{{ $route }}" method="POST">
        @csrf

        <p class="uppercase-semibold text-gray-700 mb-2">Billing & Shipping Information</p>

        <div id="billingAddress" class="mb-4">
            <x-checkout.address
                type="billing"
                :address="optional(Auth::user())->customer"
            />

            <x-checkout.toggle-btn />

        </div>

        <div id="shippingAddress" class="@hasNoDefault hidden @endhasNoDefault mb-6">
            <x-checkout.address
                type="shipping"
                :address="optional(Auth::user())->definedDefault()"
            />
        </div>

        <div id="paymentInfo">
            <p class="uppercase-semibold text-gray-700 mb-2">Payment Information</p>

            <x-checkout.stripe-elem
                :total="Present::price(ShoppingCart::totalInCents())"
            />
        </div>
    </form>
</div>