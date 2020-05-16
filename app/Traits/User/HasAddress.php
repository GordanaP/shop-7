<?php

namespace App\Traits\User;

use App\Shipping;
use Illuminate\Database\Eloquent\Collection;

trait HasAddress
{
    /**
     * Get all the user's addresses.
     */
    public function allAddresses(): Collection
    {
        return $this->shippings
            ->sortBy('is_default')
            ->reverse()
            ->prepend($this->customer->load('user.shippings'));
    }

    /**
     * Determine if the address is a billing address.
     *
     * @param mixed $address
     */
    public function isBillingAddress($address): bool
    {
        return $address->is_billing == $this->customer->is_billing;
    }

    /**
     * Manage the shipping default status.
     *
     * @param  \App\Shipping|null  $shipping
     */
    public function manageDefaultShipping($shipping = null)
    {
        $old_default = $this->findDefaultShipping()->first();

        optional($old_default)->removeDefault();

        optional($shipping)->setAsDefault();
    }

    /**
     * Determine if the address is a default shipping address.
     *
     * @param mixed $address
     * @return bool
     */
    public function isDefaultShipping($address)
    {
        return $this->findDefaultShipping()->isEmpty()
            ? $address->is_billing : $address->is_default;
    }

    /**
     * Find the default shipping.
     */
    public function findDefaultShipping(): Collection
    {
        return $this->shippings->where('is_default', 1);
    }
}
