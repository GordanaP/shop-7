<?php

namespace App\Utilities\Orders;

use App\Order;
use App\Facades\ShoppingCart;
use App\Utilities\Payments\StripeGateway;

class Orderable
{
    /**
     * The payment gateway.
     *
     * @var \App\Utilities\Payments\StripeGateway
     */
    public $gateway;

    /**
     * The purchased items.
     *
     * @var \Illuminate\Support\Collection
     */
    public $items;

    /**
     * Create a new class istance.
     *
     * @param App\Utilities\Payments\StripeGateway $gateway
     */
    public function __construct(StripeGateway $gateway)
    {
        $this->gateway = $gateway;
        $this->items = ShoppingCart::content();
    }

    /**
     * Handle the payment id and shipping data.
     *
     * @param  string $pi
     * @param  \App\Shipping|null $shipping
     */
    public function handle($pi, $shipping = null)
    {
        $order_data = $this->gateway->retrieveOrderData($pi);

        $order = Order::place($order_data, $shipping ?? null);

        $this->attachItemsToOrder($this->items, $order);
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
                'price_in_cents' => $item->calculated_price_in_cents
            ]);
        });
    }
}
