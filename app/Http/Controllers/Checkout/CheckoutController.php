<?php

namespace App\Http\Controllers\Checkout;

use App\Order;
use App\Customer;
use Carbon\Carbon;
use Stripe\Stripe;
use Illuminate\View\View;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Illuminate\Http\Request;
use App\Facades\ShoppingCart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\ApiErrorException;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $intent = PaymentIntent::create([
                'amount' => ShoppingCart::totalInCents(),
                'currency' => config('services.stripe.currency'),
            ]);

            return view('checkouts.index', [
                'clientSecret' => $intent->client_secret,
            ]);

        } catch (ApiErrorException $e) {
            return $e->getMessage();
        }
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
        Stripe::setApiKey(config('services.stripe.secret'));

        $order = $request->paymentIntent;

        $payment_method = PaymentMethod::retrieve(
            $order['payment_method']
        );

        if($registered = optional(Auth::user())->customer) {

            $customer = Customer::find($registered->id);

        } else {

            $billing = $payment_method['billing_details'];
            $address = $billing['address'];

            $name = $billing['name'];
            $street_address = $address['line1'];
            $city = $address['city'];
            $postal_code = $address['postal_code'];
            $country = $address['country'];
            $email = $billing['email'];
            $phone = $billing['phone'];

            $customer = Customer::create([
                'name' => $name,
                'street_address' => $street_address,
                'city' => $city,
                'postal_code' => $postal_code,
                'country' => $country,
                'email' => $email,
                'phone' => $phone,
                'user_id' => \Auth::id() ?? null
            ]);
        }

        $customer->placeOrder($order);

        ShoppingCart::empty();

        return response([
            'success' => route('checkouts.success')
        ]);
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

    private function orderCustomer()
    {

    }
}
