<x-layouts.app>

    @section('links')
        <link rel="stylesheet" href="{{ asset('css/stripe.css') }}">
        <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    @endsection

    @if (ShoppingCart::has('coupon'))
        <x-coupon.set-discount
            :discount="ShoppingCart::coupon()['discount']"
        />
    @endif

    <div class="row">
        <div class="col-md-7">
            <div class="lg:w-3/4 mx-auto mt-20">

                <x-checkout.payment-form
                    :route="route('checkouts.store')"
                />

                <x-alert.client />

            </div>
        </div>

        <div class="col-md-5 lg:pr-0">
            <x-checkout.order-summary
                :items="ShoppingCart::content()"
                :subtotal="Present::price(ShoppingCart::subtotalInCents()+ShoppingCart::getDiscountInCents())"
                :taxAmount="Present::price(ShoppingCart::taxAmountInCents())"
                :shippingCosts="Present::price(ShoppingCart::shippingCostsInCents())"
                :total="Present::price(ShoppingCart::totalInCents())"
                :discount="Present::price(ShoppingCart::getDiscountInCents())"
            />
        </div>
    </div>

    @section('scripts')
        <script src="https://js.stripe.com/v3/"></script>

        <script>
            var stripe = Stripe(@json(config('services.stripe.key')));

            var style = {
                base: {
                    color: "#32325d",
                    fontSmoothing: "antialiased",
                },
                invalid: {
                    color: "#fa755a",
                    iconColor: "#fa755a",
                }
            };

            var card = mountCardElement(stripe, style);
            displayCardErrors(card);

            var billingPostalCodeField = $('#billingPostal_code');
            updateCardBillingPostalCodeField(card, billingPostalCodeField);

            var displayShipping = $("#displayShipping");
            var hiddenField = $('#shippingAddress');
            displayShipping.switchStatus();
            displayShipping.clearHiddenFieldContent(hiddenField);
            var tw_gray_500 = '#a0aec0';
            var tw_gray_800 = '#2d3748';
            $('select').switchColor(tw_gray_500, tw_gray_800);

            var form = $('#paymentForm');

            form.on('submit', function(e) {
                e.preventDefault();

                var submitUrl = $(this).attr("action");
                var submitMethod = $(this).attr("method");
                var submitButton = $(this).find("button").attr("disabled", true);
                var billing = 'billing';
                var shipping = 'shipping';

                $.ajax({
                    url: submitUrl,
                    type: submitMethod,
                    data: {
                        billing: getAddress(billing),
                        displayShipping: displayShipping.val(),
                        shipping: getAddress(shipping),
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(response) {
                        var errors = response.responseJSON.errors;
                        if(errors) {
                            displayErrors(errors);
                            submitButton.removeAttr("disabled");
                        }
                    }
                })
                .then(function(response) {
                    handlePaymentResponse(response)
                });
            });

            clearErrorOnTriggeringAnEvent();

        </script>
    @endsection

</x-layouts.app>
