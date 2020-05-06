<?php

namespace App\Listeners;

use App\Events\PaymentCollected;
use App\Utilities\Orders\Orderable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaveTheOrderInTheDatabase
{
    /**
     * The order
     *
     * @var \App\Utilities\Orders\Orderable
     */
    public $orderable;

    /**
     * Create the event listener.
     *
     * @param \App\Utilities\Orders\Orderable $orderable
     */
    public function __construct(Orderable $orderable)
    {
        $this->orderable = $orderable;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PaymentCollected  $event
     */
    public function handle(PaymentCollected $event)
    {
        $this->orderable->handle($event->payment_intent_id);
    }
}
