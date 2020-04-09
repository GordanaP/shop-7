<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'customer_id', 'stripe_payment_id', 'total_in_cents', 'payment_created_at'
    // ];

    /**
     * The customer who placed the order.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public static function place($data)
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
