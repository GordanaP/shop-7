<?php

namespace App\Traits\ShoppingCart;

use App\Facades\ShoppingCart;

trait Priceable
{
    /**
     * The total in cents.
     */
    public function totalInCents(): int
    {
        return $this->total() * 100;
    }

    /**
     * The total in dollars.
     *
     * @return float
     */
    public function total()
    {
        return collect([
            $this->subtotal(),
            $this->taxAmount(),
            $this->shippingCosts(),
        ])->sum();
    }

    /**
     * The shipping costs in dollars.
     *
     * @return float
     */
    public function shippingCosts($percentage = 0.1)
    {
        $shipping_costs = ($this->subtotalInCents() * $percentage)/100;

        return number_format($shipping_costs, 2);
    }

    /**
     * The tax amount in dollars.
     *
     * @return float
     */
    public function taxAmount()
    {
        $tax_rate = config('cart.tax_rate');

        $tax_amount = ($this->subtotalInCents() * $tax_rate)/100;

        return number_format($tax_amount, 2);
    }

    /**
     * The subtotal in dollars.
     *
     * @return float
     */
    public function subtotal()
    {
        $subtotal =  $this->subtotalInCents()/100;

        return number_format($subtotal, 2);
    }

    /**
     * The subtotal in cents.
     *
     * @return integer
     */
    private function subtotalInCents()
    {
        return ShoppingCart::sum('subtotal_in_cents');
    }
}
