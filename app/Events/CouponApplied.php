<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CouponApplied
{
    use Dispatchable, SerializesModels;

    public $coupon_code;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($coupon_code)
    {
        $this->coupon_code = $coupon_code;
    }
}
