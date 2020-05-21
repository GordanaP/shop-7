<?php

namespace App\Utilities\Orders;

use Illuminate\Support\Collection;

class Address
{
    /**
     * Format address in the Stripe-required format.
     *
     * @param  array $address
     */
    public function format($address): Collection
    {
        return (new Collection)
            ->put('address', $this->locationInfo($address))
            ->union($this->personalInfo($address));
    }


    /**
     * Get the address location info.
     *
     * @param  array $address
     */
    private function locationInfo($address): Collection
    {
        return collect($address)
            ->only('street_address', 'city', 'postal_code', 'country')
            ->keyBy(function($value, $key){
                if ($key == 'street_address') {
                    return 'line1';
                } else {
                    return $key;
                }
            });
    }

    /**
     * Get the address personal info.
     *
     * @param  array $address
     */
    private function personalInfo($address): Collection
    {
        return collect($address)
            ->only('name', 'phone', 'email');
    }
}
