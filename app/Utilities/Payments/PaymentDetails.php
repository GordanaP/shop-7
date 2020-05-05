<?php

namespace App\Utilities\Payments;

use App\User;
use App\Utilities\Payments\StripeGateway;

class PaymentDetails
{
    /**
     * The payment gateway.
     *
     * @var \App\Utilities\Payments\StripeGateway
     */
    private $gateway;

    /**
     * Create a new class instance.
     *
     * @param \App\Utilities\Payments\StripeGateway $gateway
     */
    public function __construct(StripeGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * The registered user.
     *
     * @param string $pi
     */
    public function registered_user($pi)
    {
        $user_id = $this->order($pi)['user_id'];

        return User::find($user_id) ?? null;
    }

    /**
     * The order details.
     *
     * @param  string $pi
     */
    public function order($pi): array
    {
        $payment = $this->gateway->retrievePayment($pi);
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
    public function billing($pi): array
    {
        $billing = $this->gateway->retrievePaymentMethod($pi)->billing_details;

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
    public function shipping($pi)
    {
        $shipping = $this->gateway->retrievePayment($pi)->shipping;

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
}
