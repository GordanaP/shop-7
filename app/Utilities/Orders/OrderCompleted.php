<?php

namespace App\Utilities\Orders;

use App\Order;
use App\Facades\ShoppingCart;
use App\Utilities\Orders\Billable;
use App\Utilities\Orders\Deliverable;
use App\Utilities\Payments\PaymentDetails;

class OrderCompleted
{
    /**
     * The payment details.
     *
     * @var \App\Utilities\Payments\PaymentDetails
     */
    public $payment;

    /**
     * The billable customer.
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
     * The purchased items.
     *
     * @var \Illuminate\Support\Collection
     */
    public $items;

    /**
     * Create a new class istance.
     *
     * @param App\Utilities\Payments\PaymentDetails $payment
     * @param App\Utilities\Orders\Billable $billable
     * @param App\Utilities\Orders\Deliverable $deliverable
     */
    public function __construct(PaymentDetails $payment, Billable $billable, Deliverable $deliverable)
    {
        $this->payment = $payment;
        $this->billable = $billable;
        $this->deliverable = $deliverable;
        $this->items = ShoppingCart::content();
    }

    /**
     * Handle the payment once it has been completed.
     *
     * @param  string $pi
     */
    public function handle($pi)
    {
        $this->billable->handle($pi);

        $shipping = $this->deliverable->handle($pi);

        $order_data = $this->payment->order($pi);

        $order = Order::place($order_data, $shipping ?? null);

        $this->attachItemsToOrder($this->items, $order);

        ShoppingCart::empty();
    }

    /**
     * Attach the purchased items to the order.
     *
     * @param  \Illuminate\Support\Collection $items
     * @param  \App\Order $order
     */
    private function attachItemsToOrder($items, $order)
    {
        $items->map(function($item, $key) use($order) {
            $order->products()->attach($item->id, [
                'quantity' => $item->quantity,
                'price_in_cents' => $item->price_in_cents
            ]);
        });
    }
}
