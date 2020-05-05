<?php

namespace App\Utilities\Orders;

use App\User;
use App\Order;
use App\Customer;
use App\Shipping;
use Stripe\StripeObject;
use Stripe\PaymentIntent;
use App\Facades\ShoppingCart;
use App\Utilities\Payments\StripeGateway;

class OrderCompleted
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
     * Handle the payment once it has been completed.
     *
     * @param  string $pi [Stripe PaymentIntent id]
     */
    public function handle($pi)
    {
        if($this->billable($pi) && ! $this->billable($pi)->customer) {

            Customer::new($this->gateway->billingDetails($pi), $this->billable($pi));
        }

        if($this->billable($pi) && $this->shippingExists($pi)) {

            $shipping = Shipping::new($this->gateway->shippingDetails($pi), $this->billable($pi));
        }

        $order = Order::place($this->gateway->orderDetails($pi), $shipping ?? null);

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

    /**
     * The registered billable user.
     *
     * @param  string $pi
     */
    private function billable($pi): ?User
    {
        // return User::find($this->payment($pi)->metadata->user_id) ?? null;

        $user_id = $this->gateway->orderDetails($pi)['user_id'];

        return User::find($user_id) ?? null;
    }

    /**
     * The shipping details.
     *
     * @param  string $pi
     */
    private function shippingExists($pi)
    {
        // return $this->payment($pi)->shipping !== null;

        return $this->gateway->shippingDetails($pi);
    }

    /**
     * The payment.
     *
     * @param  string $pi
     */
    // private function payment($pi): PaymentIntent
    // {
    //     return $this->gateway->retrievePayment($pi);
    // }
}
