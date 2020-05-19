<?php

namespace App\Listeners;

use App\Facades\ShoppingCart;
use App\Events\PaymentCollected;
use App\Utilities\Orders\Payable;
use App\Utilities\Orders\Orderable;
use Illuminate\Support\Facades\Session;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaveThePaymentInTheDatabase
{
    /**
     * The payable.
     *
     * @var \App\Utilities\Orders\Payable
     */
    public $orderable;

    /**
     * Create the event listener.
     *
     * @param \App\Utilities\Orders\Payable $payable
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
