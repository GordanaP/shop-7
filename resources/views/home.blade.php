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

{{-- if($payment_intent->status == "succeeded")
{
    $user_id = $payment_intent->metadata->user_id;
    $user = User::find($user_id);

    Order::place($payment_intent);

    if($user) {
        if(! $user->customer) {
            $billing_details = PaymentMethod::retrieve(
                $payment_intent->payment_method
            )->billing_details;

            Customer::new($billing_details, $user);
        }

        if ($payment_intent->shipping != null) {
            Shipping::new($payment_intent);
        }
    }

    if($user && ! $user->customer) {

        $billing_details = PaymentMethod::retrieve(
            $payment_intent->payment_method
        )->billing_details;

        Customer::new($billing_details, $user);
    }

    ShoppingCart::empty();

    return response([
        'success' => route('checkouts.success')
    ]);
} --}}