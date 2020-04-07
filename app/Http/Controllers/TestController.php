<?php

namespace App\Http\Controllers;

use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->paymentIntent;

        if($data['status'] == 'succeeded')
        {
            $order = Order::create([
                'stripe_payment_id' => $data['id'],
                'total_in_cents' => $data['amount'],
                'payment_created_at' => Carbon::createFromTimestamp($data['created'])
                    ->toDateTimeString(),
                'user_id' => 1
            ]);

            ShoppingCart::empty();

            $response = 'success';
        }
        else {
            $response = 'fail';
        }

        return $response;
    }
}
