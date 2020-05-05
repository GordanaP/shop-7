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

        $order = $this->order($pi);
        $billing = $this->billing($pi);
        $shipping = $this->shipping($pi);
        $invoice = $this->createInvoice($order, $billing, $shipping);

        Mail::to($billing['email'])
            ->send(new YourOrderHasBeenReceived($order, $invoice));
    }

    /**
     * Get the order.
     *
     * @param  string $payment_intent_id
     */
    private function order($pi): Order
    {
        return Order::firstWhere('stripe_payment_id', $pi);
    }

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

    /**
     * The billing address.
     *
     * @param  string $pi
     */
    private function billing($pi): array
    {
        $billing = $this->gateway->retrievePaymentMethod($pi)
            ->billing_details;

        return [
            'name' => $billing->name,
            'street_address' => $billing->address->line1,
            'postal_code' => $billing->address->postal_code,
            'city' => $billing->address->city,
            'country' => $billing->address->country,
            'phone' => $billing->phone,
            'email' => $billing->email,
        ];
    }

    /**
     * The shipping address.
     *
     * @param  string $pi
     */
    private function shipping($pi)
    {
        $shipping = $this->gateway->retrievePayment($pi)
            ->shipping;

        if($shipping) {
            return [
                'name' => $shipping->name,
                'street_address' => $shipping->address->line1,
                'postal_code' => $shipping->address->postal_code,
                'city' => $shipping->address->city,
                'country' => $shipping->address->country,
                'phone' => $shipping->phone,
            ];
        }
    }
}
