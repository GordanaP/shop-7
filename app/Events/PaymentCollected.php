<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentCollected
{
    use Dispatchable, SerializesModels;

    /**
     * The Stripe payment intent id.
     *
     * @var string
     */
    public $payment_intent_id;

    /**
     * Create a new event instance.
     *
     * @param string $payment_intent_id
     */
    public function __construct($payment_intent_id)
    {
        $this->payment_intent_id = $payment_intent_id;
    }

}
