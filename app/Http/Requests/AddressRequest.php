<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required',
            'street_address' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'country' => [
                'required',
                Rule::in(App::make('country-list')->values())
            ],
            'is_default' => [
                'sometimes', 'required', 'boolean'
            ],
            'email' => [
                'sometimes', 'required', 'email'
            ],
        ];
    }
}
