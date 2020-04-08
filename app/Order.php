<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'stripe_payment_id', 'total_in_cents', 'payment_created_at'
    ];

    /**
     * The customer who placed the order.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function prefill($payment)
    {
        return static::create([
            'stripe_payment_id' => $payment['id'],
            'total_in_cents' => $payment['amount'],
            'payment_created_at' => Carbon::createFromTimeStamp($payment['created'], config('app.timezone')),
        ]);

    }
}
