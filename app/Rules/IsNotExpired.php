<?php

namespace App\Rules;

use App\Coupon;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class IsNotExpired implements Rule
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
        $expires_at = optional(optional(Coupon::findByCode($value))->coupon)->expires_at;

        return $expires_at > Carbon::yesterday();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The coupon has expired.';
    }
}
