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

class TestController extends Controller
{
    public function index()
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $data = PaymentIntent::retrieve('pi_1GVsMhKu08hlX7zikhN9Yzr7');

        return view('test');
    }

    public function store(Request $request)
    {
        // return $request->paymentIntent['name'];
        return $request->paymentIntent['address']['line1'];

    }

    private function shippingDetails($shipping)
    {
        return $shipping != null ? ['shipping' => $shipping] : '';
    }

}
