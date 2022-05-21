<?php

namespace App\Http\Requests\Admin\Notify;

use Illuminate\Foundation\Http\FormRequest;

class EmailFileRequest extends FormRequest
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
                'file' => 'required|file|max:6000',
                'file_name' => 'nullable|string|max:90|min:1',
                'file_description' => 'nullable|string|max:255|min:1',
                'file_save_path' => 'required|numeric|in:0,1',
            ];
        } else {
            return [
                'file_name' => 'required|string|max:90|min:1',
                'file_description' => 'nullable|string|max:255|min:1',
                'file_save_path' => 'required|numeric|in:0,1'
            ];
        }
    }
}
