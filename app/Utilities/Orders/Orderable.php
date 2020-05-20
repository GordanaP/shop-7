<?php

namespace App\Utilities\Orders;

use App\Order;
use App\Facades\ShoppingCart;
use Illuminate\Support\Facades\Session;
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
     */
    public function handle($pi)
    {
        $order = Order::place($this->data($pi));

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
                'price_in_cents' => $item->price_in_cents,
                'promotional_price_in_cents' => $item->promotional_price_in_cents,
                'promotion_id' => $item->promotion_id
            ]);
        });
    }

    /**
     * Retrieve the order data.
     *
     * @param  string $pi [description]
     */
    private function data($pi): array
    {
        return $this->gateway->retrieveOrderData($pi);
    }

    /**
     * Empty the sessions.
     */
    private function emptySessions()
    {

        Session::forget(['cart', 'shipping_id', 'is_billing']);
    }
}
