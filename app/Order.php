<?php

namespace App;

use App\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Traits\Order\Priceable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use Priceable;

    protected $with = ['user.customer'];

    protected $dates = [ 'payment_created_at' ];

    /**
     * The registered customer who placed the orders (optional).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The shipping address to dispatch the orders (optional).
     */
    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Shipping::class)->withDefault(function($shipping){
            $shipping->sameAsBilling($this->user->customer);
        });
    }

    /**
     * The coupon applied to the order (optional).
     */
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
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
        $order->coupon_id = $data->metadata->coupon_id ?? null;
        $order->payment_created_at = Carbon::createFromTimeStamp(
            $data->created, config('app.timezone')
        );

        $order->save();

        return $order;
    }

    /**
     * Get the coupon applied to order.
     */
    public function getCoupon(): array
    {
        $value = $this->coupon->value();
        $discount = $this->coupon->discount($this->subtotal_in_cents);

        return [
            'value' => $value,
            'discount' => Str::price(number_format($discount/ 100, 2)),
        ];
    }

    /**
     * The order date.
     */
    public function date(): string
    {
        return $this->payment_created_at->format('Y-d-m');
    }
}
