<?php

namespace App\Http\Controllers\Checkout;

use App\Order;
use Carbon\Carbon;
use Stripe\Stripe;
use Illuminate\View\View;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use App\Facades\ShoppingCart;
use App\Http\Controllers\Controller;
use Stripe\Exception\ApiErrorException;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $intent = PaymentIntent::create([
          'amount' => ShoppingCart::totalInCents(),
          'currency' => config('services.stripe.currency'),
        ]);

        return view('checkouts.index', [
            'clientSecret' => $intent->client_secret,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->paymentIntent;

        try {

            Order::create([
                'stripe_payment_id' => $data['id'],
                'total_in_cents' => $data['amount'],
                'payment_created_at' => Carbon::createFromTimestamp($data['created'])
                    ->toDateTimeString(),
                'user_id' => 1
            ]);

            ShoppingCart::empty();

            return response([
                'success' => route('checkouts.success')
            ]);

        } catch (ApiErrorException $e) {

            return redirect()->route('checkouts.error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
