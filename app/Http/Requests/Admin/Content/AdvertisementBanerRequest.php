<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementBanerRequest extends FormRequest
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
                'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg,ico',
                'url' => 'required|string|max:255|min:5',
                'status' => 'required|in:0,1',
                'position' => 'required|numeric',
            ];
        } else {
            return [
                'name' => 'required|max:255|min:2',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg,ico',
                'url' => 'required|string|max:255|min:5',
                'status' => 'required|in:0,1',
                'position' => 'required|numeric',
            ];
        }
    }
}
