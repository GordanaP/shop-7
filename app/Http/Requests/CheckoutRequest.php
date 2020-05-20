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
            'billing.city' => ['sometimes', 'required'],
            'billing.country' => [
                'sometimes', 'required',
                Rule::in(App::make('country-list')->values())
            ],
            'billing.street_address' => ['sometimes', 'required'],
            'billing.email' => ['sometimes', 'required', 'email'],
            'billing.name' => ['sometimes', 'required'],
            'billing.phone' => ['sometimes', 'required'],
            'billing.postal_code' => ['sometimes', 'required'],
            'displayShipping' => [
                'sometimes', 'required',
                Rule::in(['on', 'off'])
            ],
            'shipping.city' => ['sometimes', 'required_if:displayShipping,on'],
            'shipping.country' => [
                'sometimes', 'required_if:displayShipping,on',
                $this->displayShipping == 'on' ? Rule::in(App::make('country-list')->values()) : ''
            ],
            'shipping.street_address' => ['sometimes', 'required_if:displayShipping,on'],
            'shipping.email' => ['sometimes', 'required_if:displayShipping,on', 'email'],
            'shipping.name' => ['sometimes', 'required_if:displayShipping,on'],
            'shipping.phone' => ['sometimes', 'required_if:displayShipping,on'],
            'shipping.postal_code' => ['sometimes', 'required_if:displayShipping,on'],
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
            'billing.street_address.required'  => $required_field,
            'billing.city.required'  => $required_field,
            'billing.postal_code.required'  => $required_field,
            'billing.country.required'  => $required_field,
            'billing.country.in'  => $invalid_field,
            'displayShipping.required'  => $required_field,
            'displayShipping.in'  => $invalid_field,
            'shipping.name.required_if'  => $required_field,
            'shipping.phone.required_if'  => $required_field,
            'shipping.street_address.required_if'  => $required_field,
            'shipping.city.required_if'  => $required_field,
            'shipping.postal_code.required_if'  => $required_field,
            'shipping.country.required_if'  => $required_field,
            'shipping.country.in'  => $invalid_field,
        ];
    }
}
