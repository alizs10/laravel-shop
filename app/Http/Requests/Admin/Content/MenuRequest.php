<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
                'icon' => 'nullable|max:255|min:2',
                'slug' => 'required|string|max:50|min:1',
                'parent_id' => 'nullable|exists:App\Models\Content\Menu,id',
                'status' => 'required|numeric|in:0,1',
                'order_number' => 'required|integer|min:1|max:999'
            ];
        } else {
            return [
                'name' => 'required|max:255|min:2',
                'slug' => 'string|max:50|nullable',
                'parent_id' => 'nullable|exists:App\Models\Content\Menu,id',
                'status' => 'required|numeric|in:0,1',
                'order_number' => 'required|integer|min:1|max:999'
            ];
        }
    }
}
