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
     * The order subtotal.
     *
     * @var integer
     */
    protected $subtotal;

    /**
     * The coupon id.
     *
     * @var string
     */
    protected $coupon_id;

    /**
     * The discount.
     *
     * @var integer
     */
    protected $discount;

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
        $this->subtotal = ShoppingCart::subtotalInCents();
        $this->coupon_id = ShoppingCart::coupon()['id'] ?? null;
        $this->discount = ShoppingCart::coupon()['discount'] ?? null;

        ShoppingCart::setDiscount($this->discount);

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
                'order_number' => random_int(5000, 10000),
                'user_id' => $this->user_id,
                'subtotal' => $this->subtotal,
                'tax_amount' => $this->amount['tax'],
                'shipping_costs' => $this->amount['shipping_costs'],
                'coupon_id' => $this->coupon_id,
            ],
        ]);
    }

    /**
     * The order details.
     *
     * @param  string $pi
     */
    public function orderDetails($pi): array
    {
        $payment = $this->retrievePayment($pi);
        $metadata = $payment->metadata;

        return [
            'order_number' => $metadata['order_number'],
            'stripe_payment_id' => $payment['id'],
            'total_in_cents' => $payment['amount'],
            'user_id' => $metadata['user_id'] ?? null,
            'subtotal_in_cents' => $metadata['subtotal'],
            'tax_amount_in_cents' => $metadata['tax_amount'],
            'shipping_costs_in_cents' => $metadata['shipping_costs'],
            'coupon_id' => $metadata['coupon-id'] ?? null,
            'payment_created_at' => $payment['created']
        ];
    }

    /**
     * The billing address.
     *
     * @param  string $pi
     */
    public function billingDetails($pi): array
    {
        $billing = $this->retrievePaymentMethod($pi)->billing_details;

        return [
            'name' => $billing->name,
            'street_address' => $billing->address->line1,
            'postal_code' => $billing->address->postal_code,
            'city' => $billing->address->city,
            'country' => $billing->address->country,
            'phone' => $billing->phone,
            'email' => $billing->email,
        ];
    }

    /**
     * The shipping address.
     *
     * @param  string $pi
     */
    public function shippingDetails($pi)
    {
        $shipping = $this->retrievePayment($pi)->shipping;

        if($shipping) {
            return [
                'name' => $shipping->name,
                'street_address' => $shipping->address->line1,
                'postal_code' => $shipping->address->postal_code,
                'city' => $shipping->address->city,
                'country' => $shipping->address->country,
                'phone' => $shipping->phone,
            ];
        }
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
