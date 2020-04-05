<x-layouts.app>

<h1 class="mb-4">Checkout</h1>

<div class="row">
    <div class="col-md-6">
        <form id="payment-form" class="w-full lg:w-1/2">
            <div id="card-element">
                <!-- Elements will create input elements here -->
            </div>

            <!-- We'll put the error messages in this element -->
            <div id="card-errors" role="alert"></div>

            <button id="submit" class="btn btn-primary rounded-full mt-2 btn-block">
                Proceed to payment
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

        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function(ev) {
            ev.preventDefault();
            stripe.confirmCardPayment(@json($clientSecret), {
                payment_method: {
                    card: card,
                }
            }).then(function(result) {
                if (result.error) {
                    // Show error to your customer (e.g., insufficient funds)
                    console.log(result.error.message);
                } else {
                    // The payment has been processed!
                    if (result.paymentIntent.status === 'succeeded') {
                        // Show a success message to your customer
                        // There's a risk of the customer closing the window before callback
                        // execution. Set up a webhook or plugin to listen for the
                        // payment_intent.succeeded event that handles any business critical
                        // post-payment actions.
                        console.log(result.paymentIntent);
                    }
                }
            });
        });
    </script>
@endsection

</x-layouts.app>
