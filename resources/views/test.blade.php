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

                <p class="displayShipping text-xs text-red-500"></p>
            </div>

            <div id="shippingAddress" class="hidden">
                <p>Shipping details</p>
                <div class="card card-body">
                    <x-checkout.address type="shipping" />
                </div>
            </div>

            <button type="submit" class="btn btn-warning btn-block" id="testBtn">
                Submit
            </button>

        </form>
    </div>

    @section('scripts')
        <script>

        var isRegistered = @json(Auth::user());
        var hasCustomerProfile = @json(Auth::check() && Auth::user()->customer);
        var requiresBillingDetails = ! isRegistered || ! hasCustomerProfile;
        var billingAddress = 'billing';
        var shippingAddress = 'shipping';

        var displayShipping = $("#displayShipping");

        switchToggleBtn(displayShipping);

        var form = document.getElementById('testForm');

        form.addEventListener('submit', function(e){

            e.preventDefault();

            var submitFormUrl = form.action;
            var submitFormMethod = form.method;

            var paymentMethod = {
                payment_method: {
                    card: 'stripeCard',
                    billing_details : requiresBillingDetails
                        ? getAddress(billingAddress) : null
                }
            }

            $.ajax({
                url: submitFormUrl,
                type: submitFormMethod,
                data: {
                    displayShipping: displayShipping.val(),
                    shipping: getAddress(shippingAddress),
                    billing: getAddress(billingAddress),
                },
                error : function(response) {
                    var errors = response.responseJSON.errors;
                    if(errors) {
                        displayErrors(errors);
                    }
                }
            })
            .then(function(result){
                var clientSecret = result.client_secret;
                var paymentIntentId = result.payment_intent_id;
                var billing = result.billing;
                var shipping = result.shipping;
                var storeOrderUrl = @json(route('orders.store'));

                $.ajax({
                    url: storeOrderUrl,
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

        </script>
    @endsection


</x-layouts.app>