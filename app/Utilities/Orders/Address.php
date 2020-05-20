<?php

namespace App\Utilities\Orders;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class Address
{
    /**
     * Switch between the shipping addresses.
     *
     * @param  \App\Shipping  $address
     */
    public function switch($address) {

        if($address) {
            Session::forget('is_billing');
            Session::put('shipping_id', $address->id);
        } else {
            Session::forget('shipping_id');
            Session::put('is_billing', 1);
        }
    }

    /**
     * Format address in the Stripe-required format.
     *
     * @param  array $address
     */
    public function format($address): Collection
    {
        $personal_info = collect($address)
            ->only('name', 'phone', 'email');

        $address_info = collect($address)
            ->only('street_address', 'city', 'postal_code', 'country')
            ->keyBy(function($value, $key){
                if ($key == 'street_address') {
                    return 'line1';
                } else {
                    return $key;
                }
            });

        $address = (new Collection)->put('address', $address_info)
            ->union($personal_info);

        return $address;
    }
}
