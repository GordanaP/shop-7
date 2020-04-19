<?php

namespace App\Utilities\Payments;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use App\Facades\ShoppingCart;
use Illuminate\Support\Facades\Auth;

class StripeGateway
{
    /**
     * The Stripe secret key.
     *
     * @var string
     */
    private $stripe_secret_key;

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
     * @var array
     */
    protected $amount;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->stripe_secret_key = Stripe::setApiKey(config('services.stripe.secret'));
        $this->currency = config('services.stripe.currency');
        $this->user_id = Auth::id() ?? null;
        $this->amount = ShoppingCart::summaryInCents();
    }

    /**
     * Collect the payment info.
     */
    public function collectPayment(): PaymentIntent
    {
        $this->stripe_secret_key;

        return PaymentIntent::create([
            'amount' => $this->amount['total'],
            'currency' => $this->currency,
            'metadata' => [
                'user_id' => $this->user_id,
                'subtotal' => $this->amount['subtotal'],
                'tax_amount' => $this->amount['tax'],
                'shipping_costs' => $this->amount['shipping_costs'],
            ],
        ]);
    }

    /**
     * Retrieve the payment method.
     */
    public function retrievePaymentMethod($pi): PaymentMethod
    {
        $this->stripe_secret_key;

        return PaymentMethod::retrieve(
            $this->retrievePayment($pi)->payment_method
        );
    }

    /**
     * Retrieve the payment.
     */
    public function retrievePayment($pi): PaymentIntent
    {
        $this->stripe_secret_key;

        return PaymentIntent::retrieve($pi);
    }
}
