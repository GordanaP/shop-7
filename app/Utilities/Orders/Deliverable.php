<?php

namespace App\Utilities\Orders;

use App\Shipping;
use App\Utilities\Payments\PaymentDetails;

class Deliverable
{
    /**
     * The payment details.
     *
     * @var \App\Utilities\Payments\PaymentDetails
     */
    private $payment;

    /**
     * Create a new class instance.
     *
     * @param \App\Utilities\Payments\PaymentDetails $payment
     */
    public function __construct(PaymentDetails $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Handle the payment id.
     *
     * @param  string $pi
     */
    public function handle($pi)
    {
        $registered_user = $this->payment->registered_user($pi);
        $shipping_data = $this->payment->shipping($pi);

        if($registered_user && $shipping_data) {

            $shipping = Shipping::new($shipping_data, $registered_user);
        }

        return $shipping;
    }
}
