<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
                'persian_name' => 'required|max:255|min:2',
                'original_name' => 'required|max:255|min:2',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|max:255|min:2',
                'logo' => 'required|mimes:png,jpg,jpeg|max:1000',
            ];
        }
        else {
            return [
                'persian_name' => 'required|max:255|min:2',
                'original_name' => 'required|max:255|min:2',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|max:255|min:2',
                'logo' => 'nullable|mimes:png,jpg,jpeg|max:1000',
            ];
        }
    }
}
