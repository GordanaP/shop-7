<?php

namespace App\Utilities\Orders;

use App\Shipping;
use App\Utilities\Payments\StripeGateway;

class Deliverable
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
     * @param  string $pi
     */
    public function handle($pi)
    {
        $registered_user = $this->gateway->retrieveRegisteredUser($pi);
        $shipping_data = $this->gateway->retrieveShippingData($pi);

        if($registered_user && $shipping_data) {

            return Shipping::new($shipping_data, $registered_user);

        }
    }
}
