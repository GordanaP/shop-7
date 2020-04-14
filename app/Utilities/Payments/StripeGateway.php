<?php

namespace App\Utilities\Payments;

use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Auth;
use App\Utilities\Payments\AmountCollected;

class StripeGateway
{
    private $currency;

    private $payment_method_id;

    private $shipping;

    private $user_id;

    protected $amount;


    public function __construct(AmountCollected $amount)
    {
        $this->currency = config('services.stripe.currency');
        $this->payment_method_id = request('payment_method_id');
        $this->shipping = request('shipping');
        $this->user_id = Auth::id() ?? null;
        $this->amount = $amount;
    }

    public function collectPayment()
    {
        return PaymentIntent::create([
            'payment_method' => $this->payment_method_id,
            'amount' => $this->amount->inCents()['total'],
            'currency' => $this->currency,
            'metadata' => [
                'user_id' => $this->user_id,
                'subtotal' => $this->amount->inCents()['subtotal'],
                'tax_amount' => $this->amount->inCents()['tax'],
                'shipping_costs' => $this->amount->inCents()['shipping_costs'],
            ],
            'shipping' => $this->shipping,
        ]);
    }

    public function updatePayment($payment, $order)
    {
        PaymentIntent::update(
            $payment->id, [
                'metadata' => [
                    'order_id' => $order->order_number,
                ]
            ]
        );
    }
}