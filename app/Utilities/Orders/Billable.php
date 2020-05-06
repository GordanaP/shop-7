<?php

namespace App\Utilities\Orders;

use App\Customer;
use App\Utilities\Payments\StripeGateway;

class Billable
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
     * Handle the payment id.
     *
     * @param  string $pi [Stripe PaymentIntent id]
     */
    public function handle($pi)
    {
        $registered_user = $this->gateway->retrieveRegisteredUser($pi);
        $billing_data = $this->gateway->retrieveBillingData($pi);

        if($registered_user && ! $registered_user->customer) {

            Customer::new($billing_data, $registered_user);
        }
    }
}
