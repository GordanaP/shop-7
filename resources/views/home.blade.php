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

{{-- $payment = $gateway->collectPayment();
if($payment->status == "succeeded")
{
    $order = Order::place($payment);

    $gateway->updatePayment($payment, $order);

    if(Auth::check() && ! Auth::user()->customer) {
        $billing_details = PaymentMethod::retrieve(
            $payment->payment_method
        )->billing_details;

        Customer::new($billing_details, Auth::user());
    }

    if(Auth::check() && $payment->shipping !== null) {
        $shipping = Shipping::new($payment);

        $order->shipping_id = $shipping->id;
        $order->save();
    }

    ShoppingCart::empty();

    return response([
        'success' => route('checkouts.success')
    ]);
} --}}


{{-- // $payment_intent = PaymentIntent::create([
//     'payment_method' => $request->payment_method_id,
//     'amount' => ShoppingCart::totalInCents(),
//     'currency' => config('services.stripe.currency'),
//     'metadata' => [
//         'user_id' => Auth::id() ?? null,
//         'order_number' => random_int(5000, 10000),
//         'subtotal' => ShoppingCart::subtotalInCents(),
//         'tax_amount' => ShoppingCart::taxAmountInCents(),
//         'shipping_costs' => ShoppingCart::shippingCostsInCents(),
//     ],
//     'shipping' => $request->shipping,
// ]);

// $payment_intent->confirm();
 --}}
{{-- if($user_id = $payment_intent->metadata->user_id) {

    $user = User::find($user_id);

    if($user && ! $user->customer) {
        $billing_details = PaymentMethod::retrieve(
            $payment_intent->payment_method
        )->billing_details;

        Customer::new($billing_details, $user);
    }

    if($user && $payment_intent->shipping !== null) {
        $shipping = Shipping::new($payment_intent);

        $order->shipping_id = $shipping->id;
        $order->save();
    }
} --}}
{{--
    stripe.createPaymentMethod({
        type: 'card',
        card: card,
        billing_details: getAddress(billingAddress),
    })
    .then(function(result){
        if (result.error) {
            // console.log(result.error);
        } else {
            var paymentMetodId = result.paymentMethod.id;
            var submitUrl = form.action;
            var submitMethod = form.method;

            $.ajax({
                url: submitUrl,
                type: submitMethod,
                data: {
                    payment_method_id: paymentMetodId,
                    shipping: shippingDetails(displayShipping, shippingAddress),
                },
            })
            .then(function(response){
                console.log(response)
                if (response.error) {
                    // console.log(response.error)
                } else if (response.requires_action) {
                    console.log(response.payment_intent_client_secret)
                    stripe.handleCardAction(
                        response.payment_intent_client_secret
                    )
                    .then(function(result){
                        console.log(result)
                        handleStripeJsResult(result)
                    });
                } else {
                    // console.log(response);
                }
            });
        }
    });
});

function handleServerResponse(response) {
    if (response.error) {
        // console.log(response.error)
    } else if (response.requires_action) {
        handleAction(response);
    } else {
        console.log(response);
    }
}

function handleAction(response) {
    stripe.handleCardAction(
        response.payment_intent_client_secret
    )
    .then(function(result) {
        console.log(result)
        if (result.error) {
            // Show error in payment form
        } else {
            $.ajax({
                url: submitUrl,
                type: submitMethod,
                data: {
                    payment_intent_id: result.paymentIntent.id,
                }
            })
            .then(function(confirmResult) {
                return confirmResult;
            });
        }
    });
}

function handleStripeJsResult(result) {
    if (result.error) {
        console.log(result.error)
    } else {
        var paymentIntentId = result.paymentIntent.id;
        var submitUrl = form.action;
        var submitMethod = form.method;

        $.ajax({
            url: submitUrl,
            type: submitMethod,
            data: {
                payment_intent_id: paymentIntentId,
            },
        })
        .then(function(confirmResult) {
            console.log(confirmResult)
        });
    } --}}