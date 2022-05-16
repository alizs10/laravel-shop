<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:90',
            'type' => 'required|numeric|in:0,1',
            'cat_id' => 'required|numeric|exists:product_categories,id',
            'unit' => 'required|string|min:1|max:90',
        ];
    }
}
