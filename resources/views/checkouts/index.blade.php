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
            var billingAddress = 'billing';
            var shippingAddress = 'shipping';
            var displayShipping = $("#displayShipping");

            switchToggleBtn(displayShipping);

            var stripe = Stripe(@json(config('services.stripe.key')));
            var elements = stripe.elements();

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

            var card = elements.create("card", {
                style: style,
                hidePostalCode: true
            });

            card.mount("#card-element");

            card.addEventListener('change', ({error}) => {
                const displayError = document.getElementById('card-errors');
                if (error) {
                    displayError.classList.add('text-danger', 'text-xs');
                    displayError.textContent = error.message;
                } else {
                    displayError.classList.remove('text-danger', 'text-xs');
                    displayError.textContent = '';
                }
            });

            var billingPostalCodeField = getById('billingPostal_code');

            if(billingPostalCodeField.value) {
                card.update({value: {postalCode: billingPostalCodeField.value}});
            } else {
                billingPostalCodeField.addEventListener('change', function(event) {
                    card.update({value: {postalCode: event.target.value}});
                });
            }

            var form = document.getElementById('paymentForm');
            var submitUrl = form.action;
            var submitMethod = form.method;
            var submitButton = document.getElementById('submitPaymentButton');

            form.addEventListener('submit', function(ev) {
                ev.preventDefault();
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
                            displayErrors(errors)
                        }
                    }
                })
                .then(function(response){
                    var clientSecret = response.client_secret;
                    var billingAd = response.billing
                    var shippingAd = response.shipping;

                    stripe.confirmCardPayment(clientSecret, {
                        payment_method: {
                            card: card,
                            billing_details: billingAd
                        },
                        shipping: shippingAd
                    })
                    .then(function(result) {
                        if (result.error) {
                            $('.alert-danger').show().text(result.error.message)
                        } else {
                            if (result.paymentIntent.status === 'succeeded') {

                                var paymentIntentId = result.paymentIntent.id;

                                $.ajax({
                                    url: '/orders',
                                    type: 'POST',
                                    data: {
                                        payment_intent_id: paymentIntentId
                                    },
                                })
                                .then(function(result) {
                                    redirectTo(result.success)
                                });
                            }
                        }
                    });
                });
            });

        </script>
    @endsection

</x-layouts.app>
