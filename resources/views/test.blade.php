<x-layouts.app>

    @section('links')
        <link rel="stylesheet" href="{{ asset('css/stripe.css') }}">
        <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    @endsection

    <div class="row">

        <div class="col-md-7">
            <div class="lg:w-3/4 mx-auto mt-20">
                <p class="text-center instruction px-2 absolute">
                    Complete your details below
                </p>

                <x-checkout.payment-form
                    :route="route('tests.store')"
                    :total="ShoppingCart::total()"
                />
            </div>
        </div>

        <div class="col-md-5 lg:pr-0">
            <div class="bg-white p-4 border-b border-b-gray-100 text-2xl"
            style="margin-top: 3px">
                <p class="my-2">Order Summary</p>
            </div>

            <x-checkout.order-summary
                :items="ShoppingCart::content()"
                :subtotal="ShoppingCart::subtotal()"
                :taxAmount="ShoppingCart::taxAmount()"
                :shippingCosts="ShoppingCart::shippingCosts()"
                :total="ShoppingCart::total()"
            />
        </div>
    </div>

    @section('scripts')
        <script>

        var displayShipping = $("#displayShipping");
        var hiddenField = $('#shippingAddress');
        displayShipping.switchStatus();
        displayShipping.clearHiddenFieldContent(hiddenField);

        var form = $('#paymentForm');
        var field = $('#billingPostal_code');

        form.on('submit', function(e) {

            e.preventDefault();

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
            .then(function(result){
                console.log(result)
                // var paymentIntentId = 'pi_1GYwmsKu08hlX7zidIq5kWhG'; // reg && shipp
                // var paymentIntentId = 'pi_1GYs43Ku08hlX7ziWrJyNz0T'; // reg && non ship
                // var paymentIntentId = 'pi_1GYqc8Ku08hlX7ziTABUnjq1'; // non reg
                var billing = result.billing;
                var shipping = result.shipping;

                $.ajax({
                    url: '/orders',
                    type: 'POST',
                    data: {
                        payment_intent_id: paymentIntentId
                    },
                })
                .then(function(result) {
                    console.log(result)
                });
            });
        });

        clearErrorOnTriggeringAnEvent();

        </script>
    @endsection

</x-layouts.app>

{{-- <form action="{{ route('tests.store') }}" method = "POST" id="paymentForm">

    @csrf

    <div id="billingAddress" class="mb-2">
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

        <div class="displayShipping invalid-feedback text-xs text-red-500"></div>

    </div>

    <div id="shippingAddress" class="hidden">
        <p>Shipping details</p>
        <div class="card card-body">
            <x-checkout.address type="shipping" />
        </div>
    </div>

    <button type="submit" class="btn btn-warning btn-block"
    id="submitPaymentBtn">
        Submit
    </button>

</form> --}}