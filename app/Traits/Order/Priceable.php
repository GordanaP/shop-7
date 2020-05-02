<?php

namespace App\Traits\Order;

use Illuminate\Support\Str;

trait Priceable
{
    /**
     * The total amount.
     */
    public function total(): object
    {
        $total = number_format($this->total_in_cents / 100, 2);

        return Str::price($total);
    }

    /**
     * The subtotal.
     */
    public function subtotal(): object
    {
        $subtotal = number_format($this->subtotal_in_cents / 100, 2);

        return Str::price($subtotal);
    }

    /**
     * The tax amount.
     */
    public function taxAmount(): object
    {
        $tax_amount = number_format($this->tax_amount_in_cents / 100, 2);

        return Str::price($tax_amount);
    }

    /**
     * The shipping costs.
     */
    public function shippingCosts(): object
    {
        $shipping_costs = number_format($this->shipping_costs_in_cents / 100, 2);

        return Str::price($shipping_costs);
    }
}
