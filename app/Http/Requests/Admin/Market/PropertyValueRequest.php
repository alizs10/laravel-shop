<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class PropertyValueRequest extends FormRequest
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
            'product_id' => 'required|numeric|exists:products,id',
            'value' => 'required|string|min:1|max:90',
            'price_increase' => 'required|numeric',
            'marketable_number' => 'required|numeric|min:0'
        ];
    }
}
