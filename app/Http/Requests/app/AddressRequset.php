<?php

namespace App\Http\Requests\app;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequset extends FormRequest
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
            'province' => 'required|numeric|exists:provinces,id',
            'city_id' => 'required|numeric|exists:cities,id',
            'address' => 'required|string|max:255',
            'unit' => 'nullable|numeric',
            'no' => 'required|numeric',
            'receiver_name' => 'required|string|min:7|max:90',
            'receiver_mobile' => 'required|digits:11',
            'postal_code' => 'required|digits:10',
        ];
    }
}
