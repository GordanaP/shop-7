<x-layouts.app>

    <h1>Test</h1>

    <span></span>

    <div class="col-md-3">

        <form action="{{ route('tests.store') }}" method = "POST" id="testForm">

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

        </form>
    </div>

    @section('scripts')
        <script>

        // var isRegistered = @json(Auth::user());
        // var hasCustomerProfile = @json(Auth::check() && Auth::user()->customer);
        // var requiresBillingDetails = ! isRegistered || ! hasCustomerProfile;

        var displayShipping = $("#displayShipping");
        var hiddenField = $('#shippingAddress');
        displayShipping.switchStatus();
        displayShipping.clearHiddenFieldContent(hiddenField);

        var form = $('#testForm');
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
                var paymentIntentId = 'pi_1GYqc8Ku08hlX7ziTABUnjq1'; // non reg
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
                    // redirectTo(result.success)
                });
            });
        });

        clearErrorOnTriggeringAnEvent();

        </script>
    @endsection


</x-layouts.app>