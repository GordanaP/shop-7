<?php

namespace App;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    /**
     * Create a new shipping.
     *
     * @param  Stripe\PaymentMethod $data
     * @param  \App\User $user
     */
    public static function new($data, $user): Shipping
    {
        $shipping = new static;

        $shipping->name = $data['name'];
        $shipping->phone = $data['phone'];
        $shipping->street_address = $data['street_address'];
        $shipping->postal_code = $data['postal_code'];
        $shipping->city = $data['city'];
        $shipping->country = $data['country'];
        $shipping->user_id = $user->id;

        $shipping->save();

        return $shipping;
    }

    /**
     * The shipping address is same as the billing address.
     *
     * @param  \App\Customer $customer
     */
    public function sameAsBilling($customer): Shipping
    {
        $this->name = $customer->name;
        $this->street_address = $customer->street_address;
        $this->postal_code = $customer->postal_code;
        $this->city = $customer->city;
        $this->country = $customer->country;
        $this->phone = $customer->phone;

        return $this;
    }

    /**
     * The shipping country name.
     */
    public function countryName(): string
    {
        return App::make('country-list')->key(strtolower($this->country));
    }
}
