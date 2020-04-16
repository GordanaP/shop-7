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

                    <p class="displayShipping text-xs text-red-500"></p>
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

                <button id="submitPaymentButton" class="btn bg-warning rounded-full
                mt-2 btn-block">
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

            var billingPostalCodeField = getById('billingPostal_code');
            updateCardBillingPostalCodeField(card, billingPostalCodeField);

            var displayShipping = $("#displayShipping");
            switchToggleBtn(displayShipping);

            clearErrorOnTriggeringAnEvent();

            var form = document.getElementById('paymentForm');

            form.addEventListener('submit', function(ev) {
                ev.preventDefault();

                var billingAddress = 'billing';
                var shippingAddress = 'shipping';
                var submitUrl = form.action;
                var submitMethod = form.method;
                var submitButton = document.getElementById('submitPaymentButton');
                submitButton.disabled = true;

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
                            submitButton.disabled = false;
                        }
                    }
                })
                .then(function(response){
                    handlePaymentResponse(response)
                });
            });

        </script>
    @endsection

</x-layouts.app>
