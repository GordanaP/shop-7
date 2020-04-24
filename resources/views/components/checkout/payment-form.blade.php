<div class="border border-gray-400 px-4 pb-4 pt-8">
    <form id="paymentForm" action="{{ route('checkouts.store') }}" method="POST">

        @csrf

        <p class="uppercase-semibold text-gray-700 mb-2">
            Billing & Shipping Information
        </p>

        <div id="billingAddress" class="mb-4">
            <x-checkout.address type="billing" />

            <div class="mt-2">
                <div class="form-check form-check-inline mt-2">
                    <input class="form-check-input" type="checkbox"
                    id="displayShipping"
                    value="off"
                    onclick="toggleVisibility('#shippingAddress')"
                    >
                    <label class="form-check-label" for="displayShipping">
                        Different shipping address
                    </label>
                </div>
            </div>

            <p class="displayShipping invalid-feedback text-error"></p>
        </div>

        <div id="shippingAddress" class="hidden mb-6">
            <x-checkout.address type="shipping" />
        </div>

        <div id="paymentInfo">
            <p class="uppercase-semibold text-gray-700 mb-2">
                Payment Information
            </p>

            <x-checkout.stripe-elem :total="$total" />
        </div>
    </form>
</div>