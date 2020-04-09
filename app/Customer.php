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

    public static function new($data, $user)
    {
        $customer = new static;

        $customer->name = $data['name'];
        $customer->email = $data['email'];
        $customer->phone = $data['phone'];
        $customer->street_address = $data['address']['line1'];
        $customer->postal_code = $data['address']['postal_code'];
        $customer->city = $data['address']['city'];
        $customer->country = $data['address']['country'];
        $customer->user_id = $user->id;

        $customer->save();

        return $customer;
    }
}
