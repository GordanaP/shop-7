<x-layouts.app>

@section('links')
    <style type="text/css">

        .StripeElement {
          box-sizing: border-box;

          height: 40px;

          padding: 10px 12px;

          border: 1px solid transparent;
          border-radius: 4px;
          background-color: white;

          box-shadow: 0 1px 3px 0 #e6ebf1;
          -webkit-transition: box-shadow 150ms ease;
          transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
          box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
          border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
          background-color: #fefde5 !important;
        }
    </style>
@endsection
<h3 class="mb-2">Checkout</h1>

<div class="row">
    <div class="col-md-6">

        <p >Billing details</p>

        <form id="paymentForm" action="{{ route('checkouts.store') }}" method="POST"
         class="w-full lg:w-1/2" >

            <div class="card card-body">
                <div class="form-group">
                    <input type="text" id="billingName"
                    placeholder="Name"
                    class="form-control"
                    value="{{ Auth::check() ? optional(Auth::user()->customer)->name ?? '' : '' }}">
                </div>

                <div class="form-group">
                    <input type="text" id="billingLine1"
                    placeholder="Street address"
                    class="form-control"
                    value="{{  Auth::check() ? optional(Auth::user()->customer)->street_address ?? '' : ''}}">
                </div>

                <div class="form-group">
                    <input type="text" id="billingPostal_code"
                    placeholder="Postal Code"
                    class="form-control"
                    value="{{ Auth::check() ? optional(Auth::user()->customer)->postal_code ?? '' : ''}}">
                </div>

                <div class="form-group">
                    <input type="text" id="billingCity"
                    placeholder="City"
                    class="form-control"
                    value="{{ Auth::check() ? optional(Auth::user()->customer)->city ?? '' : '' }}">
                </div>

                <div class="form-group">
                    <input type="text" id="billingCountry"
                    placeholder="Country"
                    class="form-control"
                    value="{{ Auth::check() ? optional(Auth::user()->customer)->country ?? '' : '' }}">
                </div>

                <div class="form-group">
                    <input type="text" id="billingPhone"
                    placeholder="Phone Number"
                    class="form-control"
                    value="{{ Auth::check() ? optional(Auth::user()->customer)->phone ?? '' : '' }}">
                </div>

                <div class="form-group">
                    <input type="text" id="billingEmail"
                    placeholder="E-mail address"
                    class="form-control"
                    value="{{ Auth::check() ? optional(Auth::user()->customer)->email ?? '' : '' }}">
                </div>

                <div id="card-element">
                    <!-- Elements will create input elements here -->
                </div>

                <!-- We'll put the error messages in this element -->
                <div id="card-errors" role="alert"></div>

                <button id="submitPaymentButton" class="btn bg-warning rounded-full
                mt-2 btn-block">
                    Pay {{ Str::withCurrency(ShoppingCart::total()) }}
                </button>
            </div>
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
        var requiresBillingDetails = ! isRegistered || ! hasCustomerProfile;

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

            stripe.confirmCardPayment(@json($clientSecret), {
                payment_method: {
                    card: card,
                    billing_details : customerDetails(requiresBillingDetails)

                    // billing_details : {
                    //     name : getById('billingName').value,
                        // address : {
                        //     line1 : getById('billingStreetAddress').value,
                        //     line2 : ' ',
                        //     city : getById('billingCity').value,
                        //     postal_code : getById('billingPostalCode').value,
                        //     country : getById('billingCountry').value,
                        // },
                        // phone: getById('billingPhone').value,
                        // email: getById('billingEmail').value
                    // }
                }
            }).then(function(result) {
                var error = result.error;

                if (error) {
                    $('#card-errors').text(error.message).addClass('text-danger');
                    submitButton.disabled = false;

                } else {
                    var paymentIntent = result.paymentIntent;
                    var submitUrl = form.action;
                    var submitMethod = form.method;

                    console.log(paymentIntent)

                    $.ajax({
                        url: submitUrl,
                        type: submitMethod,
                        data: {
                            paymentIntent: paymentIntent
                        },
                    })
                    .done(function(response) {
                        redirectTo(response.success)
                    });
                }
            });
        });

    </script>
@endsection

</x-layouts.app>
