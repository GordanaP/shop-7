<?php

namespace App\Http\Controllers\Order;

use App\User;
use App\Order;
use App\Customer;
use App\Shipping;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Illuminate\Http\Request;
use App\Facades\ShoppingCart;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $payment = PaymentIntent::retrieve(
            $request->payment_intent_id
        );

        $order = Order::place($payment);

        $user_id = $payment->metadata->user_id;
        $user = User::find($user_id);

        if($user && ! $user->customer) {
            $billing_details = PaymentMethod::retrieve(
                $payment->payment_method
            )->billing_details;

            Customer::new($billing_details, $user);
        }

        if($user && $payment->shipping !== null) {
            $shipping = Shipping::new($payment);

            $order->shipping_id = $shipping->id;
            $order->save();
        }

        ShoppingCart::empty();

        return response([
            'success' => route('checkouts.success')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
