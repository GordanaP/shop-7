<?php

namespace App\Listeners;

use App\Order;
use Illuminate\Http\Response;
use App\Events\PaymentCollected;
use Illuminate\Support\Facades\Mail;
use App\Mail\YourOrderHasBeenReceived;
use App\Utilities\General\PDFGenerator;
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
     * The PDF documents generator.
     *
     * @var \App\Utilities\General\PDFGenerator
     */
    public $pdf_generator;

    /**
     * Create the event listener.
     *
     * @param \App\Utilities\Payments\StripeGateway $gateway
     * @param \App\Utilities\General\PDFGenerator $pdf_generator
     */
    public function __construct(StripeGateway $gateway, PDFGenerator $pdf_generator)
    {
        $this->gateway = $gateway;
        $this->pdf_generator = $pdf_generator;
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
        $invoice = $this->createInvoice($order);

        Mail::to($billing_email)
            ->send(new YourOrderHasBeenReceived($order, $invoice));
    }

    /**
     * Get the billing email.
     *
     * @param  string $payment_intent_id
     */
    private function billingEmail($payment_intent_id): string
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
    private function order($payment_intent_id): Order
    {
        return Order::firstWhere('stripe_payment_id', $payment_intent_id);
    }

    /**
     * Create an invoice in the PDF format.
     *
     * @param  \App\Order $order
     */
    private function createInvoice($order): Response
    {
        return $this->pdf_generator->download('orders.pdf', compact('order'));
    }
}
