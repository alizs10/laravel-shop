<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'name' => 'required|max:255|min:2',
                'description' => 'required|max:500|min:2',
                'status' => 'required|numeric|in:0,1',
                'show_in_menu' => 'required|numeric|in:0,1',
                'tags' => 'required|max:255|min:2',
                'image' => 'required|mimes:png,jpg,jpeg|max:1000',
                'parent_id' => 'nullable|numeric|exists:product_categories,id',
            ];
        }
        else {
            return [
                'name' => 'required|max:255|min:2',
                'description' => 'required|max:500|min:2',
                'status' => 'required|numeric|in:0,1',
                'show_in_menu' => 'required|numeric|in:0,1',
                'tags' => 'required|max:255|min:2',
                'image' => 'nullable|mimes:png,jpg,jpeg|max:1000',
                'parent_id' => 'nullable|numeric|exists:product_categories,id',
            ];
        }
    }
}
