<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class YourOrderHasBeenReceived extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order.
     *
     * @var \App\Order
     */
    public $order;

    /**
     * The invoice.
     *
     * @var \Illuminate\App\Response
     */
    public $invoice;

    /**
     * Create a new message instance.
     *
     * @param \App\Order $order
     * @param \Illuminate\App\Response $invoice
     */
    public function __construct($order, $invoice)
    {
        $this->order = $order;
        $this->invoice = $invoice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order-received')
            ->subject('Order #'.$this->order->order_number)
            ->attachData($this->invoice, 'invoice_'.$this->order->order_number.'.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
