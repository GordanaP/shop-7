<?php

namespace App;

use App\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Str;
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
        $order->coupon_code = $data->metadata->coupon_code ?? null;
        $order->payment_created_at = Carbon::createFromTimeStamp(
            $data->created, config('app.timezone')
        );

        $order->save();

        return $order;
    }

    public function getCoupon()
    {
        $coupon = Coupon::findByCode($this->coupon_code);

        $value = $coupon->value();
        $discount = $coupon->discount($this->subtotal_in_cents);

        return [
            'value' => $value,
            'discount' => Str::price(number_format($discount/ 100, 2)),
        ];
    }

    public function total()
    {
        $total = number_format($this->total_in_cents / 100, 2);

        return Str::price($total);
    }

    public function subtotal()
    {
        $subtotal = number_format($this->subtotal_in_cents / 100, 2);

        return Str::price($subtotal);
    }

    public function taxAmount()
    {
        $tax_amount = number_format($this->tax_amount_in_cents / 100, 2);

        return Str::price($tax_amount);
    }

    public function shippingCosts()
    {
        $shipping_costs = number_format($this->shipping_costs_in_cents / 100, 2);

        return Str::price($shipping_costs);
    }

    public function date()
    {
        return Carbon::parse($this->payment_created_at)->format('Y-d-m');
    }
}
