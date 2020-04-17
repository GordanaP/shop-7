<x-layouts.app>

    @section('links')
        <link rel="stylesheet" href="{{ asset('css/stripe.css') }}">
    @endsection

    <h3 class="mb-2">Checkout</h1>

    .<div class="alert alert-danger text-center hidden">
    </div>

    <div class="row">
        <div class="col-md-6">

            <form id="paymentForm" action="{{ route('checkouts.store') }}" method="POST"
             class="w-full lg:w-1/2" >

                <div id="billingAddress" class="mb-2">
                    <p >Billing details</p>
                    <div class="card card-body">
                        <x-checkout.address type="billing" />
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox"
                        name="displayShipping"
                        id="displayShipping"
                        value="off"
                        onclick="toggleVisibility('#shippingAddress')"
                        >
                        <label class="form-check-label" for="displayShipping">
                            Different shipping address
                        </label>
                    </div>

                    <p class="displayShipping invalid-feedback text-xs text-red-500"></p>
                </div>

                <div id="shippingAddress" class="hidden">
                    <p>Shipping details</p>
                    <div class="card card-body">
                        <x-checkout.address type="shipping" />
                    </div>
                </div>

                <div id="card-element" class="mt-4">
                    <!-- Elements will create input elements here -->
                </div>

                <!-- We'll put the error messages in this element -->
                <div id="card-errors" role="alert"></div>

                <button class="btn bg-warning rounded-full mt-2 btn-block">
                    Pay {{ Str::withCurrency(ShoppingCart::total()) }}
                </button>
            </form>
        </div>

        <div class="col-md-6">

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

            var form = $('#paymentForm');

            form.on('submit', function(ev) {
                ev.preventDefault();

                var billingAddress = 'billing';
                var shippingAddress = 'shipping';
                var submitUrl = $(this).attr("action");
                var submitMethod = $(this).attr("method");
                var submitButton = $(this).find("button").attr("disabled", true);

                $.ajax({
                    url: submitUrl,
                    type: submitMethod,
                    data: {
                        displayShipping: displayShipping.val(),
                        shipping: getAddress(shippingAddress),
                        billing: getAddress(billingAddress),
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
