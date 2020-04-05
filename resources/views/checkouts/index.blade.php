<x-layouts.app>

<h1 class="mb-4">Checkout</h1>

<div class="row">
    <div class="col-md-6">
        <form id="payment-form" class="w-1/2">
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
        var stripe = Stripe('pk_test_TYooMQauvdEDq54NiTphI7jx');
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
    </script>
@endsection

</x-layouts.app>
