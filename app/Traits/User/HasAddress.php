<?php

namespace App\Traits\User;

use App\Customer;
use App\Shipping;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Collection;

trait HasAddress
{
    public function shippingId()
    {
        $address = $this->shippingOnCheckout();

        return ! $this->isBillingAddress($address) ? $address->id : null;
    }

    public function shippingOnCheckout()
    {
        if(Session::has('shipping_id')) {
            $address = Shipping::find(Session::get('shipping_id'));
        } elseif (Session::has('is_billing')) {
            $address = $this->customer;
        } else {
            $address = $this->getDefaultShipping();
        }

        return $address;
    }

    public function getDefaultShipping()
    {
        return $this->findDefaultShipping()->first() ?? $this->customer;
    }

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
