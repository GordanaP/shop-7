<?php

namespace App\Http\Controllers\Checkout;

use App\User;
use App\Order;
use App\Customer;
use App\Shipping;
use Stripe\Stripe;
use Illuminate\View\View;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Illuminate\Http\Request;
use App\Facades\ShoppingCart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckoutRequest;
use Stripe\Exception\ApiErrorException;
use App\Utilities\Payments\StripeGateway;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request, StripeGateway $gateway)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $billing = $request->validated()['billing'];
        $shipping = $request->validated()['shipping'];

        return response([
            'client_secret' => $gateway->collectPayment()->client_secret,
            // 'payment_intent_id' => $gateway->collectPayment()->id,
            'billing' => $billing,
            'shipping' => $shipping
        ]);
    }
}
