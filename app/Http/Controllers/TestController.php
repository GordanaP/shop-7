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

class TestController extends Controller
{
    public function index()
    {
        return view('test');
    }

    public function store(CheckoutRequest $request)
    {
        return response([
            'client_secret' => '12345',
            'billing' => $request->billing,
            'shipping' => $request->shipping
        ]);
    }

}
