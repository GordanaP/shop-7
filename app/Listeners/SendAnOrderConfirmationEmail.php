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
     * @param  \App\Events\PaymentCollected  $event
     */
    public function handle(PaymentCollected $event)
    {
        $pi = $event->payment_intent_id;

        // $order = $this->order($pi);
        $order = Order::findByPaymentId($pi);
        $billing = $this->gateway->billingDetails($pi);
        $shipping = $this->gateway->shippingDetails($pi);
        $invoice = $this->createInvoice($order, $billing, $shipping);

        Mail::to($billing['email'])
            ->send(new YourOrderHasBeenReceived($order, $invoice));
    }

    /**
     * Get the order.
     *
     * @param  string $payment_intent_id
     */
    // private function order($pi): Order
    // {
    //     return Order::firstWhere('stripe_payment_id', $pi);
    // }

    /**
     * Create an invoice in the PDF format.
     *
     * @param  \App\Order $order
     * @param  array $billing
     * @param  array $shipping
     */
    private function createInvoice($order, $billing, $shipping): Response
    {
        return $this->pdf_generator
            ->download('pdfs.invoice', compact('order', 'billing', 'shipping'));
    }
}
