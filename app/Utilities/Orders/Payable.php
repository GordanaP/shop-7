<?php

namespace App\Utilities\Orders;

use App\Facades\ShoppingCart;
use App\Utilities\Orders\Billable;
use App\Utilities\Orders\Orderable;
use App\Utilities\Orders\Deliverable;

class Payable
{
    /**
     * The billable user.
     *
     * @var \App\Utilities\Orders\Billable
     */
    public $billable;

    /**
     * The deliverable data.
     *
     * @var \App\Utilities\Orders\Deliverable
     */
    public $deliverable;

    /**
     * The orderable data.
     *
     * @var \App\Utilities\Orders\Orderable
     */
    public $orderable;

    /**
     * Create a new class istance.
     *
     * @param App\Utilities\Payments\StripeGateway $gateway
     * @param App\Utilities\Orders\Billable $billable
     * @param App\Utilities\Orders\Deliverable $deliverable
     */
    public function __construct(Billable $billable, Deliverable $deliverable, Orderable $orderable)
    {
        $this->billable = $billable;
        $this->deliverable = $deliverable;
        $this->orderable = $orderable;
    }

    /**
     * Handle the payment.
     *
     * @param  string $pi
     */
    public function handle($pi)
    {
        $this->billable->handle($pi);

        $shipping = $this->deliverable->handle($pi);

        $this->orderable->handle($pi, $shipping);

        ShoppingCart::empty();
    }
}
