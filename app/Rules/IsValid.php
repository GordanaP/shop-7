<?php

namespace App\Rules;

use App\Coupon;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Validation\Rule;

class IsValid implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $from = Coupon::findByCode($value)->valid_from;
        $to = Coupon::findByCode($value)->expires_at;

        $validPeriod = CarbonPeriod::create($from, $to);

        return $validPeriod->isInProgress();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The coupon is invalid.';
    }
}
