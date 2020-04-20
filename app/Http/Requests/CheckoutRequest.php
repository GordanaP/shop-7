<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'billing.name' => 'required',
            'billing.email' => 'required|email',
            'billing.phone' => 'required',
            'billing.address.line1' => 'required',
            'billing.address.city' => 'required',
            'billing.address.country' => [
                'required',
                Rule::in(App::make('country-list')->values())
            ],
            'billing.address.postal_code' => 'required',
            'displayShipping' => [
                'required',
                Rule::in(['on', 'off'])
            ],
            'shipping.name' => 'required_if:displayShipping,on',
            'shipping.phone' => 'required_if:displayShipping,on',
            'shipping.address.line1' => 'required_if:displayShipping,on',
            'shipping.address.city' => 'required_if:displayShipping,on',
            'shipping.address.country' => [
                'required_if:displayShipping,on',
                Rule::in(App::make('country-list')->values())
            ],
            'shipping.address.postal_code' => 'required_if:displayShipping,on',
        ];
    }
}
