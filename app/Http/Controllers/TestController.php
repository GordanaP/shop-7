<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Customer;
use Carbon\Carbon;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Requests\CheckoutRequest;
use App\Utilities\Payments\StripeGateway;

class TestController extends Controller
{
    public function index()
    {
        return view('test');
    }

    public function store(CheckoutRequest $request, StripeGateway $gateway)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $billing = $request->validated()['billing'];
        $shipping = $request->validated()['shipping'];

        return response([
            'client_secret' => $gateway->collectPayment()->client_secret,
            'payment_intent_id' => $gateway->collectPayment()->id,
            'billing' => $billing,
            'shipping' => $shipping
        ]);
    }

}
