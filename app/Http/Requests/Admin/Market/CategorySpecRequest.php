<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CategorySpecRequest extends FormRequest
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
        if ($this->isMethod('POST')) {
            return [
                'spec'=> 'required|array|min:1',
                'spec.*' => 'required'
            ];
        } else {
            return [
                'name' => 'required|string|max:90',
                'default_value' => 'required|string|max:900',
                'status' => 'required|in:0,1',
            ];
        }
    }
}
