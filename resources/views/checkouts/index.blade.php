<x-layouts.app>

<h1 class="mb-4">Checkout</h1>

<div class="row">
    <div class="col-md-6">
        <form id="paymentForm" action="{{ route('checkouts.store') }}" method="POST"
         class="w-full lg:w-1/2" >
            <div id="card-element">
                <!-- Elements will create input elements here -->
            </div>

            <!-- We'll put the error messages in this element -->
            <div id="card-errors" role="alert"></div>

            <button id="submitPaymentButton" class="btn btn-primary rounded-full mt-2 btn-block">
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

        var card = elements.create("card", { style: style });
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

        var form = document.getElementById('paymentForm');
        var submitButton = document.getElementById('submitPaymentButton');

        form.addEventListener('submit', function(ev) {
            ev.preventDefault();
            submitButton.disabled = true;

            stripe.confirmCardPayment(@json($clientSecret), {
                payment_method: {
                    card: card,
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
