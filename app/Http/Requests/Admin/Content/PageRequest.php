<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'title' => 'required|max:255|min:2',
            'body' => 'required|min:2',
            'status' => 'required|numeric|in:0,1',
            'tags' => 'required|max:255|min:2',

        ];
    }

    public function attributes()
    {
        return [
            'body' => 'محتوای صفحه',
        ];
    }
}
