<?php

namespace App\Traits\User;

use App\Customer;
use App\Shipping;
use Illuminate\Database\Eloquent\Collection;

trait HasAddress
{
    /**
     * Create a new shipping address.
     *
     * @param array $data
     */
    public function addShippingAddress($data): Shipping
    {
        $shipping = new Shipping($data);

        return $this->shippings()->save($shipping);
    }

    /**
     * Create a new customer profile.
     *
     * @param array $data
     */
    public function addBillableAddress($data): Customer
    {
        $profile = new Customer($data);

        return $this->customer()->save($profile);
    }

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
        $old_default = $this->definedDefault();

        optional($old_default)->removeDefault();

        optional($shipping)->setAsDefault();
    }

    /**
     * Determine if the address is a default shipping address.
     *
     * @param mixed $address
     * @return bool
     */
    public function isAssignedDefault($address)
    {
        return $this->hasNoDefinedDefault()
            ? $address->is_billing : $address->is_default;
    }

    // public function isDefaultShipping($address)
    // {
    //     return $this->hasNoDefinedDefault()
    //         ? $address->is_billing : $address->is_default;
    // }

    /**
     * Find the default shipping.
     */
    // public function findDefaultShipping(): Collection
    // {
    //     return $this->shippings->where('is_default', 1);
    // }

    public function hasNoDefinedDefault()
    {
        return $this->shippings->where('is_default', 1)->isEmpty();
    }

    public function hasDefinedDefault()
    {
        return $this->shippings->where('is_default', 1)->isNotEmpty();
    }

    public function definedDefault()
    {
        return $this->shippings->where('is_default', 1)->first();
    }
}
