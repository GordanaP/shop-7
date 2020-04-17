<?php

namespace App\Utilities\Payments;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use App\Utilities\Payments\AmountCollected;

class StripeGateway
{
    /**
     * The stripe currency.
     *
     * @var string
     */
    private $currency;

    /**
     * The user id.
     *
     * @var int
     */
    private $user_id;

    /**
     * The amount collected for payment.
     *
     * @var \App\Utilities\Payments\AmountCollected
     */
    protected $amount;

    /**
     * The unique Stripe PaymentIntent identifier.
     *
     * @var string
     */
    protected $payment_intent_id;

    /**
     * Create a new class instance.
     *
     * @param \App\Utilities\Payments\AmountCollected $amount
     */
    public function __construct(AmountCollected $amount)
    {
        $this->currency = config('services.stripe.currency');
        $this->user_id = Auth::id() ?? null;
        $this->amount = $amount;
        $this->payment_intent_id = request('payment_intent_id');
    }

    /**
     * Collect the payment info.
     */
    public function collectPayment(): PaymentIntent
    {
        return PaymentIntent::create([
            'amount' => $this->amount->inCents()['total'],
            'currency' => $this->currency,
            'metadata' => [
                'user_id' => $this->user_id,
                'subtotal' => $this->amount->inCents()['subtotal'],
                'tax_amount' => $this->amount->inCents()['tax'],
                'shipping_costs' => $this->amount->inCents()['shipping_costs'],
            ],
        ]);
    }

    /**
     * Retrieve the payment info.
     */
    public function retrievePayment(): PaymentIntent
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        return PaymentIntent::retrieve(
            $this->payment_intent_id
        );
    }

    /**
     * Retrieve the payment method.
     */
    public function retrievePaymentMethod(): PaymentMethod
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        return PaymentMethod::retrieve(
            $this->retrievePayment()->payment_method
        );
    }
}
