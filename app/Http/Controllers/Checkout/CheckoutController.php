<?php

namespace App\Http\Controllers\Checkout;

use Illuminate\View\View;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use Stripe\Exception\ApiErrorException;
use App\Utilities\Payments\StripeGateway;
use App\Utilities\Orders\Address;

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
     * @param  \App\Utilities\Payments\StripeGateway  $gateway
     * @param  \App\Utilities\Orders\Address  $address
     */
    public function store(CheckoutRequest $request, StripeGateway $gateway, Address $address): Response
    {
        try {
            $billing = $address->format($request->validated()['billing']);
            $shipping = $address->format($request->validated()['shipping']);

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
