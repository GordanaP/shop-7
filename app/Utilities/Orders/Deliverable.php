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
     * Create a new shipping address for the registered user.
     *
     * @param  string $pi
     */
    public function handle($pi)
    {
        $registered_user = $this->gateway->retrieveRegisteredUser($pi);
        $data = $this->gateway->retrieveShippingData($pi);

        $data ? optional($registered_user)->addShippingAddress($data) : '';
    }
}
