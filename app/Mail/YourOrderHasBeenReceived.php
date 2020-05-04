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
     * Create a new message instance.
     *
     * @param \App\Order $order
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order-received')
            ->subject('Order #'.$this->order->order_number);
    }
}
