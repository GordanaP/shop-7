<?php

namespace App\Listeners;

use App\Order;
use App\Events\PaymentCollected;
use Illuminate\Support\Facades\Mail;
use App\Mail\YourOrderHasBeenReceived;
use Illuminate\Queue\InteractsWithQueue;
use App\Utilities\Payments\StripeGateway;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAnOrderConfirmationEmail
{
    /**
     * The Stripe gateway.
     *
     * @var \App\Utilities\Payments\StripeGateway
     */
    public $gateway;

    /**
     * Create the event listener.
     *
     * @param \App\Utilities\Payments\StripeGateway $gateway
     */
    public function __construct(StripeGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * Handle the event.
     *
     * @param  PaymentCollected  $event
     */
    public function handle(PaymentCollected $event)
    {
        $billing_email = $this->billingEmail($event->payment_intent_id);
        $order = $this->order($event->payment_intent_id);

        Mail::to($billing_email)->send(new YourOrderHasBeenReceived($order));
    }

    /**
     * Get the billing email.
     *
     * @param  string $payment_intent_id
     */
    public function billingEmail($payment_intent_id): string
    {
        $billing = $this->gateway->retrievePaymentMethod($payment_intent_id)
            ->billing_details;

        return $billing['email'];
    }

    /**
     * Get the order.
     *
     * @param  string $payment_intent_id
     */
    public function order($payment_intent_id): Order
    {
        return Order::firstWhere('stripe_payment_id', $payment_intent_id);
    }
}
