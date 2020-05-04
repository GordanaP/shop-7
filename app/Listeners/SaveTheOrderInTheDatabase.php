<?php

namespace App\Listeners;

use App\Events\PaymentCollected;
use App\Utilities\Orders\OrderCompleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaveTheOrderInTheDatabase
{
    /**
     * The Order
     *
     * @var [type]
     */
    public $order;

    /**
     * Create the event listener.
     */
    public function __construct(OrderCompleted $order)
    {
        $this->order = $order;
    }

    /**
     * Handle the event.
     *
     * @param  PaymentCollected  $event
     */
    public function handle(PaymentCollected $event)
    {
        $this->order->handle($event->payment_intent_id);
    }
}
