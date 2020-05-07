<?php

namespace App\Traits\ShoppingCart;

use App\Coupon;

trait Discountable
{
    /**
     * Set the discount.
     *
     * @param integer $discount
     */
    public static function setDiscount($discount)
    {
        static::$discount = $discount;
    }

    /**
     * Get the discount.
     */
    public static function getDiscountInCents(): ?float
    {
        return static::$discount;
    }

    /**
     * Calculate the discount.
     */
    public function coupon(): array
    {
        $coupon = Coupon::find($this->get('coupon'));
        $amount = $this->subtotalInCents();

        return [
            'id' => $this->get('coupon'),
            'discount' => optional($coupon)->applyDiscount($amount),
            'name' => optional($coupon)->name(),
        ];
    }

    /**
     * Remove the coupon.
     */
    public function removeCoupon()
    {
        $this->forget('coupon');

        $this->save();
    }

    /**
     * Add the coupon to the cart.
     *
     * @param string $code
     */
    public function addCoupon($code)
    {
        $this->put('coupon', $code);

        $this->save();
    }
}
