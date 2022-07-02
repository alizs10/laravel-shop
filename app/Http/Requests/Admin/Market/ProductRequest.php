<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                'introduction' => 'required|max:1000|min:2',
                'status' => 'required|numeric|in:0,1',
                'marketable' => 'required|numeric|in:0,1',
                'tags' => 'required|max:255|min:2',
                'image' => 'required|mimes:png,jpg,jpeg|max:2000',
                'brand_id' => 'nullable|numeric|exists:brands,id',
                'cat_id' => 'required|numeric|exists:product_categories,id',
                'published_at' => 'required|digits:13',
                'height' => 'required|numeric',
                'width' => 'required|numeric',
                'length' => 'required|numeric',
                'weight' => 'required|numeric',
                'price' => 'required|numeric',
                'meta_key.*' => 'nullable|max:90',
                'meta_value.*' => 'nullable|max:90',
            ];
        }
        else {
            return [
                'name' => 'required|max:255|min:2',
                'introduction' => 'required|max:1000|min:2',
                'status' => 'required|numeric|in:0,1',
                'marketable' => 'required|numeric|in:0,1',
                'tags' => 'required|max:255|min:2',
                'image' => 'nullable|mimes:png,jpg,jpeg|max:2000',
                'brand_id' => 'nullable|numeric|exists:brands,id',
                'cat_id' => 'required|numeric|exists:product_categories,id',
                'published_at' => 'required|digits:13',
                'height' => 'required|numeric',
                'width' => 'required|numeric',
                'length' => 'required|numeric',
                'weight' => 'required|numeric',
                'price' => 'required|numeric',
                'meta_key.*' => 'nullable|max:90',
                'meta_value.*' => 'nullable|max:90',
            ];
        }
    }
}
