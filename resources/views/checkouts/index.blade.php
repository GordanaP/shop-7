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
                <p class="text-center instruction px-2 absolute">
                    Complete your details below
                </p>

                <x-checkout.payment-form
                    :route="route('checkouts.store')"
                />
            </div>

            <div class="alert alert-danger text-center hidden mx-auto
            lg:w-3/4 mt-2"></div>
        </div>

        <div class="col-md-5 lg:pr-0">
            <div class="bg-white p-4 border-b border-b-gray-100 text-2xl"
            style="margin-top: 3px">
                <p class="my-2">Order Summary</p>
            </div>
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

            form.on('submit', function(ev) {
                ev.preventDefault();

                var billing = 'billing';
                var shipping = 'shipping';
                var submitUrl = $(this).attr("action");
                var submitMethod = $(this).attr("method");
                var submitButton = $(this).find("button").attr("disabled", true);

                $.ajax({
                    url: submitUrl,
                    type: submitMethod,
                    data: {
                        billing: getAddress(billing),
                        displayShipping: displayShipping.val(),
                        shipping: getAddress(shipping),
                    },
                    error : function(response) {
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
