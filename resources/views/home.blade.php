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

{{--
// Stripe::setApiKey(config('services.stripe.secret'));

// $payment = PaymentIntent::retrieve(
//     $request->payment_intent_id
// );

// $order = Order::place($payment);

// $user_id = $payment->metadata->user_id;
// $user = User::find($user_id);

// if($user && ! $user->customer) {
//     $billing_details = PaymentMethod::retrieve(
//         $payment->payment_method
//     )->billing_details;

//     Customer::new($billing_details, $user);
// }

// if($user && $payment->shipping !== null) {
//     $shipping = Shipping::new($payment);

//     $order->shipping_id = $shipping->id;
//     $order->save();
// }

// ShoppingCart::empty();
 --}}

{{--  public $gateway;

 public function __construct(StripeGateway $gateway)
 {
     $this->gateway = $gateway;
 }

 public function execute()
 {
     $this->storeBillable();

     $shipping = $this->storeShipping();

     Order::place($this->payment(), $shipping);

     $this->emptyShoppingCart();
 }
 --}}
{{--
 public function storeBillable()
 {
     $user = $this->isRegisteredBillable();
     $billing_details = $this->billingDetails();

     if($user && ! $user->customer) {
         Customer::new($billing_details, $user);
     }
 }

 public function storeShipping()
 {
     // $user = $this->isRegisteredCustomer();
     if($this->isRegisteredBillable() && $this->shippingDetails()) {

         return  Shipping::new($this->payment());
     }
 }

 public function emptyShoppingCart()
 {
     ShoppingCart::empty();
 }

 private function isRegisteredBillable()
 {
     $registered_user = User::find($this->BillableId());

     return $registered_user ?? null;
 }

 private function shippingDetails()
 {
     return $this->payment()->shipping !== null;
 }

 private function billingDetails()
 {
     return $this->gateway->retrievePaymentMethod()->billing_details;
 }

 private function BillableId()
 {
     return $this->payment()->metadata->user_id;
 }

 private function payment()
 {
     return $this->gateway->retrievePayment();
 }

 // private function isRegisteredCustomer()
 // {
 //     $user_id = $this->payment()->metadata->user_id;

 //     $user = User::find($user_id);

 //     return $user ?? null;
 // }

 // private function method()
 // {
 //     return $this->gateway->retrievePaymentMethod();
 // } --}}