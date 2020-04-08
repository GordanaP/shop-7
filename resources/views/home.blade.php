<x-layouts.app>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

{{-- form.addEventListener('submit', function(ev) {
    ev.preventDefault();
    submitButton.disabled = true;

    stripe.confirmCardPayment(@json($clientSecret), {
        payment_method: {
            card: card,
        }
    }).then(function(result) {
        if (result.error) {
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
                console.log(response)
            })
            .fail(function(response) {
                console.log(response)
            });
        }
    });
}); --}}