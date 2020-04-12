<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    /**
     * The customer who placed the order.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Place an order.
     *
     * @param  array $data
     */
    public static function place($data): Order
    {
        $order = new static;

        $order->user_id = $data->metadata->user_id ?? null;
        $order->order_number = $data->metadata->order_number;
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
