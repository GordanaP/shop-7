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

        $user_id = 1;
        $user = User::find($user_id);

         if($user && ! $user->customer) {

             $billing_details = PaymentMethod::retrieve(
                 $data->payment_method
             )->billing_details;

             Customer::new($billing_details, $user);
         }

        // $order = new Order;

        // $order->user_id = $data->metadata->user_id ?? null;
        // $order->order_number = null;
        // $order->stripe_payment_id = $data->id;
        // $order->total_in_cents = $data->amount;
        // $order->subtotal_in_cents = 200;
        // $order->tax_amount_in_cents = 20;
        // $order->shipping_costs_in_cents = 10;
        // $order->payment_created_at = Carbon::createFromTimeStamp(
        //     $data->created, config('app.timezone')
        // );

        // $order->save();

        return view('test');
    }

    public function store(Request $request)
    {
        return $request->all();
    }
}
