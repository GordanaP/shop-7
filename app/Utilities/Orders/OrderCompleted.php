<?php

namespace App\Utilities\Orders;

use App\User;
use App\Order;
use App\Customer;
use App\Shipping;
use App\Facades\ShoppingCart;
use App\Utilities\Payments\StripeGateway;

class OrderCompleted
{
    /**
     * The payment.
     *
     * @var \Stripe\PaymentIntent
     */
    public $payment;

    /**
     * The billing details.
     *
     * @var \Stripe\PaymentIntent
     */
    public $billing;

    /**
     * The shipping details.
     *
     * @var \Stripe\PaymentIntent
     */
    public $shipping;

    /**
     * The registered user.
     *
     * @var \App\User
     */
    public $billable;

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
        $this->payment = $gateway->retrievePayment();
        $this->billing = $gateway->retrievePaymentMethod()->billing_details;
        $this->shipping = $this->payment->shipping;
        $this->billable = User::find($this->payment->metadata->user_id) ?? null;
        $this->items = ShoppingCart::content();
    }

    /**
     * Handle order info once the payment has been completed.
     */
    public function handleInfo()
    {
        if($this->billable && ! $this->billable->customer) {

            Customer::new($this->billing, $this->billable);
        }

        if($this->billable && $this->shipping !== null) {

            $shipping = Shipping::new($this->payment);
        }

        $order = Order::place($this->payment, $shipping ?? null);

        $this->attachItemsToOrder($this->items, $order);

        ShoppingCart::empty();
    }

    /**
     * Attach the purchased items to the order.
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
