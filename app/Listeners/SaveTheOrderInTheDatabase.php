<?php

namespace App\Listeners;

use App\Events\PaymentCollected;
use App\Utilities\Orders\Payable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaveTheOrderInTheDatabase
{
    /**
     * The payable.
     *
     * @var \App\Utilities\Orders\Payable
     */
    public $payable;

    /**
     * Create the event listener.
     *
     * @param \App\Utilities\Orders\Payable $payable
     */
    public function __construct(Payable $payable)
    {
        $this->payable = $payable;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PaymentCollected  $event
     */
    public function handle(PaymentCollected $event)
    {
        $this->payable->handle($event->payment_intent_id);
    }
}
