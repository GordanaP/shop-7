<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    /**
     * The customer who placed the orders.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The shipping address to dispatch the orders .
     */
    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Shipping::class);
    }

    /**
     * The orders' products.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->as('ordered')
            ->withPivot('quantity', 'price_in_cents');
    }

    /**
     * Place an order.
     *
     * @param  Stripe\PaymentIntent $data
     */
    public static function place($data, $shipping = null): Order
    {
        $order = new static;

        $order->user_id = $data->metadata->user_id ?? null;
        $order->shipping_id = optional($shipping)->id ?? null;
        $order->order_number = random_int(5000, 10000);
        $order->stripe_payment_id = $data->id;
        $order->total_in_cents = $data->amount;
        $order->subtotal_in_cents = $data->metadata->subtotal;
        $order->tax_amount_in_cents = $data->metadata->tax_amount;
        $order->shipping_costs_in_cents = $data->metadata->shipping_costs;
        $order->payment_created_at = Carbon::createFromTimeStamp(
            $data->created, config('app.timezone')
        );

        $order->save();

        return $order;
    }
}
