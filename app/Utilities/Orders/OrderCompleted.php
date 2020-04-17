<?php

namespace App\Utilities\Orders;

use App\User;
use App\Order;
use App\Customer;
use App\Shipping;
use App\Facades\ShoppingCart;
use App\Utilities\Payments\StripeGateway;

class OrderCompleted
{
    /**
     * The payment.
     *
     * @var Stripe\PaymentIntent
     */
    public $payment;

    /**
     * The billing details.
     *
     * @var Stripe\PaymentIntent
     */
    public $billing;

    /**
     * The shipping details.
     *
     * @var Stripe\PaymentIntent
     */
    public $shipping;

    /**
     * The registered user.
     *
     * @var App\User
     */
    public $billable;

    /**
     * Create a new class istance.
     *
     * @param App\Utilities\Payments\StripeGateway $gateway
     */
    public function __construct(StripeGateway $gateway)
    {
        $this->payment = $gateway->retrievePayment();
        $this->billing = $gateway->retrievePaymentMethod()->billing_details;
        $this->shipping = $this->payment->shipping;
        $this->billable = User::find($this->payment->metadata->user_id) ?? null;
    }

    /**
     * Handle order info once the payment has been completed.
     */
    public function handleInfo()
    {
        if($this->billable && ! $this->billable->customer) {

            Customer::new($this->billing, $this->billable);
        }

        if($this->billable && $this->shipping !== null) {

            $shipping = Shipping::new($this->payment);
        }

        Order::place($this->payment, $shipping ?? null);

        ShoppingCart::empty();
    }
}
