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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'street_address', 'postal_code', 'city', 'country', 'email',
    //     'phone', 'user_id'
    // ];

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

    public static function new($data)
    {
        $billing = $data['billing_details'];
        $address = $billing['address'];

        $customer = new static;

        $customer->name = $billing['name'];
        $customer->email = $billing['email'];
        $customer->phone = $billing['phone'];
        $customer->street_address = $address['line1'];
        $customer->postal_code = $address['postal_code'];
        $customer->city = $address['city'];
        $customer->country = $address['country'];
        $customer->user_id = Auth::id() ?? null;

        $customer->save();

        return $customer;
    }

    public function placeOrder($order)
    {
        $this->orders()->create([
            'stripe_payment_id' => $order['id'],
            'total_in_cents' => $order['amount'],
            'payment_created_at' => Carbon::createFromTimeStamp($order['created'], config('app.timezone')),
        ]);
    }
}
