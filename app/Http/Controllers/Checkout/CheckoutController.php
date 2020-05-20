<?php

namespace App\Http\Controllers\Checkout;

use Illuminate\View\View;
use Illuminate\Http\Response;
use App\Utilities\Orders\Address;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckoutRequest;
use Stripe\Exception\ApiErrorException;
use App\Utilities\Payments\StripeGateway;

class CheckoutController extends Controller
{
    /**
     * The address.
     *
     * @var App\Utilities\Orders\Address
     */
    private $address;

    /**
     * The Stripe gateway.
     *
     * @var App\Utilities\Payments\StripeGateway
     */
    private $gateway;

    /**
     * Make a new class instance.
     *
     * @param App\Utilities\Orders\Address $address
     * @param App\Utilities\Payments\StripeGateway $gateway
     */
    public function __construct(Address $address, StripeGateway $gateway)
    {
        $this->address = $address;
        $this->gateway = $gateway;
    }

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
    public function store(CheckoutRequest $request): Response
    {
        try {

            $billing =
                Auth::check()
                ? $this->address->format(Auth::user()->customer)
                : $this->address->format($request->validated()['billing']);

            $shipping =
                Auth::check()
                ? $this->address->format(Auth::user()->selectedShipping())->forget('email')
                : $this->address->format($request->validated()['shipping']);

            return response([
                'client_secret' => $this->gateway->collectPayment()->client_secret,
                'billing' => $billing,
                'shipping' => $shipping
            ]);

        } catch (ApiErrorException $e) {
            return $e->getMessage();
        }
    }
}
