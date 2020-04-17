<?php

namespace App\Http\Controllers\Checkout;

use Stripe\Stripe;
use Illuminate\View\View;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
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
     * @param  \App\Http\Requests\CheckoutRequest  $request
     */
    public function store(CheckoutRequest $request, StripeGateway $gateway): Response
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $billing = $request->validated()['billing'];
            $shipping = $request->validated()['shipping'];

            return response([
                'client_secret' => $gateway->collectPayment()->client_secret,
                'billing' => $billing,
                'shipping' => $shipping
            ]);

        } catch (ApiErrorException $e) {
            return $e->getMessage();
        }
    }
}
