<?php

namespace App\Utilities\Orders;

use App\Customer;
use App\Utilities\Payments\PaymentDetails;

class Billable
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
     * @param  string $pi [Stripe PaymentIntent id]
     */
    public function handle($pi)
    {
        $registered_user = $this->payment->registered_user($pi);
        $billing_data = $this->payment->billing($pi);

        if($registered_user && ! $registered_user->customer) {

            Customer::new($billing_data, $registered_user);
        }
    }
}
