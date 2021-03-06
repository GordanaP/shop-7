<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    /**
     * The customer's user account.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The customer's orders.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Create a new customer.
     *
     * @param  array $data
     * @param  \App\User $user
     */
    public static function new($data, $user): Customer
    {
        $customer = new static;

        $customer->name = $data['name'];
        $customer->email = $data['email'];
        $customer->phone = $data['phone'];
        $customer->street_address = $data['street_address'];
        $customer->postal_code = $data['postal_code'];
        $customer->city = $data['city'];
        $customer->country = $data['country'];
        $customer->user_id = $user->id;

        $customer->save();

        return $customer;
    }
}
