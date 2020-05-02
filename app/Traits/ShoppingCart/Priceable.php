<?php

namespace App\Traits\ShoppingCart;

trait Priceable
{
    /**
     * The price's summary in cents.
     */
    public function summaryInCents(): array
    {
        return [
            'total' => $this->totalInCents(),
            'tax' => $this->taxAmountInCents(),
            'shipping_costs' => $this->shippingCostsInCents(),
        ];
    }

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
        $total = collect([
            $this->subtotal(),
            $this->taxAmount(),
            $this->shippingCosts(),
        ])->sum();

        return number_format($total, 2);
    }

    /**
     * The shipping costs in dollars.
     *
     * @return float
     */
    public function shippingCosts()
    {
        $shipping_costs = $this->shippingCostsInCents()/100;

        return number_format($shipping_costs, 2);
    }

    /**
     * The tax amount in dollars.
     *
     * @return float
     */
    public function taxAmount()
    {
        $tax_amount = $this->taxAmountInCents()/100;

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
     * The shipping costs in cents.
     *
     * @return integer
     */
    public function shippingCostsInCents($percentage = 0.1)
    {
        return $this->subtotalInCents() * $percentage;
    }

    /**
     * The tax amount in cents.
     *
     * @return integer
     */
    public function taxAmountInCents()
    {
        $tax_rate = config('cart.tax_rate');

        return $this->subtotalInCents() * $tax_rate;
    }

    /**
     * The subtotal in cents reduced by the discount amount.
     *
     * @return integer
     */
    public function subtotalInCents()
    {
        return $this->sum('subtotal_in_cents') - static::$discount;
    }
}
