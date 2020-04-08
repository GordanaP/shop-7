<x-layouts.app>

    <h1>Test</h1>

    <div class="col-md-3">

        <form action="{{ route('tests.store') }}" method = "POST" id="testForm">

            @csrf

            <div class="form-group">
                <input type="text" id="billingName"
                placeholder="Name"
                class="form-control">
            </div>

            <div class="form-group">
                <input type="text" id="billingLine1"
                placeholder="Street address"
                class="form-control">
            </div>

            <div class="form-group">
                <input type="text" id="billingPostal_code"
                placeholder="Postal Code"
                class="form-control"
                value="11000">
            </div>

            <div class="form-group">
                <input type="text" id="billingCity"
                placeholder="City"
                class="form-control">
            </div>

            <div class="form-group">
                <input type="text" id="billingCountry"
                placeholder="Country"
                class="form-control">
            </div>

            <div class="form-group">
                <input type="text" id="billingPhone"
                placeholder="Phone Number"
                class="form-control">
            </div>

            <div class="form-group">
                <input type="text" id="billingEmail"
                placeholder="E-mail address"
                class="form-control">
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

        var billingPostalCodeField = getById('billingPostal_code');

        if(billingPostalCodeField.value){
            var postalCode = billingPostalCodeField.value;
            console.log(postalCode)
        } else {
            billingPostalCodeField.addEventListener('change', function(event) {
                var postalCode = event.target.value;
                console.log(postalCode)
              // card.update({value: {postalCode: event.target.value}});
            });
        }

        var form = document.getElementById('testForm');

        form.addEventListener('submit', function(e){
            e.preventDefault();

            var submitUrl = form.action;
            var submitMethod = form.method;

            var paymentMethod = {
                payment_method: {
                    card: 'strIpeCard',
                    billing_details : customerDetails(requiresBillingDetails)
                }
            }

            $.ajax({
                url: submitUrl,
                type: submitMethod,
                data: {
                    paymentMethod: paymentMethod
                },
            })
            .done(function(response) {
                console.log(response)
            });
        });

        </script>
    @endsection

</x-layouts.app>