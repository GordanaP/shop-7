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
    public static function new($data): Shipping
    {
        $shipping = new static;

        $shipping->name = $data->shipping->name;
        $shipping->phone = $data->shipping->phone;
        $shipping->street_address = $data->shipping->address['line1'];
        $shipping->postal_code = $data->shipping->address['postal_code'];
        $shipping->city = $data->shipping->address['city'];
        $shipping->country = $data->shipping->address['country'];
        $shipping->user_id = $data->metadata->user_id;

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
