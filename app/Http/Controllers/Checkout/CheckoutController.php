<?php

namespace App\Http\Controllers\Checkout;

use App\User;
use App\Order;
use App\Customer;
use Stripe\Stripe;
use Illuminate\View\View;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Illuminate\Http\Request;
use App\Facades\ShoppingCart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\ApiErrorException;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('checkouts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $payment_intent = PaymentIntent::create([
            'payment_method' => $request->payment_method_id,
            'amount' => ShoppingCart::totalInCents(),
            'currency' => config('services.stripe.currency'),
            'metadata' => [
                'user_id' => Auth::id() ?? null,
                'order_number' => random_int(5000, 10000),
                'subtotal' => ShoppingCart::subtotalInCents(),
                'tax_amount' => ShoppingCart::taxAmountInCents(),
                'shipping_costs' => ShoppingCart::shippingCostsInCents(),
            ],
            'shipping' => $request->shipping,
        ]);

        $payment_intent->confirm();

        if($payment_intent->status == "succeeded")
        {
            Order::place($payment_intent);

            $user_id = $payment_intent->metadata->user_id;
            $user = User::find($user_id);

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
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
