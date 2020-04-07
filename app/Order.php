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
        'user_id', 'stripe_payment_id', 'total_in_cents', 'payment_created_at'
    ];

    /**
     * The user who placed the order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
