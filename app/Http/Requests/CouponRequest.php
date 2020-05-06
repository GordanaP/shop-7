<?php

namespace App\Http\Requests;

use App\Coupon;
use App\Rules\IsValid;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => [
                'bail','required',
                Rule::in(Coupon::all()->pluck('code')),
                new IsValid,
            ]
        ];
    }
}
