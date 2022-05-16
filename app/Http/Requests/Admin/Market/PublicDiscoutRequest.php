<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class PublicDiscoutRequest extends FormRequest
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
            'title' => 'required|string|max:90',
            'percentage' => 'required|numeric|min:1|max:100',
            'maximum_discount' => 'required|numeric',
            'minimum_order_amount' => 'required|numeric',
            'valid_from' => 'required|digits:13',
            'valid_until' => 'required|digits:13',
        ];
    }
}
