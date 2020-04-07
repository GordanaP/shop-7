<x-layouts.app>

    <h1>Test</h1>

    <form id="paymentForm" action="{{ route('tests.store') }}" method="POST"
     class="w-full lg:w-1/2" >

        @csrf

        <div id="card-element">
            <!-- Elements will create input elements here -->
        </div>

        <!-- We'll put the error messages in this element -->
        <div id="card-errors" role="alert"></div>

        <button id="submitPaymentButton" class="btn btn-primary rounded-full mt-2 btn-block">
            Pay
        </button>
    </form>

    @section('scripts')
        <script>

            var form = document.getElementById('paymentForm');

            form.addEventListener('submit', function(ev) {
                ev.preventDefault();

                var submitUrl = form.action;
                var submitMethod = form.method;

                var paymentIntent = {
                    id: "pi_1GUx3YKu08hlX7ziTOEFZ2f5",
                    amount: 1068,
                    created: 1586187612,
                    currency: "usd",
                    status: "succeeded"
                }

                $.ajax({
                    url: submitUrl,
                    type: submitMethod,
                    data: {
                        paymentIntent: paymentIntent
                    },
                })
                .done(function(response) {
                    console.log(response)
                })
                .fail(function(response) {
                    console.log(response)
                });
            });

        </script>
    @endsection

</x-layouts.app>