<?php

namespace App\Http\Controllers\Checkout;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * @param  \App\Http\Requests\CheckoutRequest  $request
     */
    public function store(CheckoutRequest $request, StripeGateway $gateway)
    {
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
