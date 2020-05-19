<?php

namespace App\Http\Requests;

use Illuminate\Support\Arr;
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
     */
    public function rules(): array
    {
        return [
            'billing.name' => 'sometimes|required',
            'billing.email' => 'sometimes|required|email',
            'billing.phone' => 'sometimes|required',
            'billing.address.line1' => 'sometimes|required',
            'billing.address.city' => 'sometimes|required',
            'billing.address.postal_code' => 'sometimes|required',
            'billing.address.country' => [
                'sometimes','required',
                Rule::in(App::make('country-list')->values())
            ],
            'displayShipping' => [
                'sometimes','required',
                Rule::in(['on', 'off'])
            ],
            'shipping.name' => 'sometimes|required_if:displayShipping,on',
            'shipping.phone' => 'sometimes|required_if:displayShipping,on',
            'shipping.address.line1' => 'sometimes|required_if:displayShipping,on',
            'shipping.address.city' => 'sometimes|required_if:displayShipping,on',
            'shipping.address.postal_code' => 'sometimes|required_if:displayShipping,on',
            'shipping.address.country' => 'sometimes|required_if:displayShipping,on',
            'shipping.address.country' => [
                'sometimes', 'required_if:displayShipping,on',
                ($this->shipping['address']['country'] !== null && $this->displayShipping == 'on')
                ? Rule::in(App::make('country-list')->values()) : ''
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        $required_field = 'The value is required.';
        $invalid_field = 'The value is invalid.';

        return [
            'billing.name.required'  => $required_field,
            'billing.email.required'  => $required_field,
            'billing.email.email'  => $invalid_field,
            'billing.phone.required'  => $required_field,
            'billing.address.line1.required'  => $required_field,
            'billing.address.city.required'  => $required_field,
            'billing.address.postal_code.required'  => $required_field,
            'billing.address.country.required'  => $required_field,
            'billing.address.country.in'  => $invalid_field,
            'displayShipping.required'  => $required_field,
            'displayShipping.in'  => $invalid_field,
            'shipping.name.required_if'  => $required_field,
            'shipping.phone.required_if'  => $required_field,
            'shipping.address.line1.required_if'  => $required_field,
            'shipping.address.city.required_if'  => $required_field,
            'shipping.address.postal_code.required_if'  => $required_field,
            'shipping.address.country.required_if'  => $required_field,
            'shipping.address.country.in'  => $invalid_field,
        ];
    }
}
