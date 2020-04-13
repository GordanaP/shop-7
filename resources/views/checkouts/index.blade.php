<x-layouts.app>

    @section('links')
        <link rel="stylesheet" href="{{ asset('css/stripe.css') }}">
    @endsection

    <h3 class="mb-2">Checkout</h1>

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
                        name="different_shipping_address"
                        id="toggleShipping"
                        value="off"
                        onclick="toggleVisibility('#shippingAddress')"
                        >
                        <label class="form-check-label" for="toggleShipping">
                            Different shipping address
                        </label>
                    </div>
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
            var isRegistered = @json(Auth::user());
            var hasCustomerProfile = @json(Auth::check() && Auth::user()->customer);
            var requiresBilling = (! isRegistered || ! hasCustomerProfile) ? true : false;
            var billingAddress = 'billing';
            var shippingAddress = 'shipping';

            var toggleShipping = $("#toggleShipping");

            switchToggleBtn(toggleShipping);

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
            var submitButton = document.getElementById('submitPaymentButton');

            form.addEventListener('submit', function(ev) {
                ev.preventDefault();
                submitButton.disabled = true;

                stripe.createPaymentMethod({
                    type: 'card',
                    card: card,
                    billing_details: getAddress(billingAddress),
                }).then(function(result){
                    if (result.error) {
                        // Show error in payment form
                    } else {
                        var paymentMetodId = result.paymentMethod.id;
                        var submitUrl = form.action;
                        var submitMethod = form.method;

                        $.ajax({
                            url: submitUrl,
                            type: submitMethod,
                            data: {
                                payment_method_id: paymentMetodId,
                                shipping: shippingDetails(toggleShipping, shippingAddress),
                            },
                            error: function(response) {
                                // var errors = response.responseJSON.errors;
                                // displayServerSideErrors(errors)
                            }
                        }).then(function(result) {
                            redirectTo(result.success);
                        });
                    }
                });

            });

        </script>
    @endsection

</x-layouts.app>
