<?php

namespace App;

use App\Coupon;
use Carbon\Carbon;
use App\Facades\Present;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'user.customer'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
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

        $order->user_id = $data['user_id'];
        $order->shipping_id = optional($shipping)->id ?? null;
        $order->order_number = $data['order_number'];
        $order->stripe_payment_id = $data['stripe_payment_id'];
        $order->total_in_cents = $data['total_in_cents'];
        $order->subtotal_in_cents = $data['subtotal_in_cents'];
        $order->tax_amount_in_cents = $data['tax_amount_in_cents'];
        $order->shipping_costs_in_cents = $data['shipping_costs_in_cents'];
        $order->coupon_id = $data['coupon_id'];
        $order->payment_created_at = Carbon::createFromTimeStamp(
            $data['payment_created_at'], config('app.timezone')
        );

        $order->save();

        return $order;
    }

    /**
     * Get the order by payment id.
     *
     * @param  string $pi
     */
    public static function findByPaymentId($pi)
    {
        return static::firstWhere('stripe_payment_id', $pi);
    }

    /**
     * Get the coupon applied to order.
     */
    public function getCoupon(): array
    {
        $name = $this->coupon->name();
        $discount = $this->coupon->applyDiscount($this->subtotal_in_cents);

        return [
            'name' => $name,
            'discount' => Present::price($discount),
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
