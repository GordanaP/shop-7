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