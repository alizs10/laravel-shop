<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
                'name' => 'required|string|max:90|min:2',
                'description' => 'nullable|string|max:255|min:2',
                'permission_id' => 'required|array|min:1',
                'permission_id.*' => 'required|numeric|exists:permissions,id',
                'status' => 'required|numeric|in:0,1'
            ];
        } else {
            return [
                'name' => 'required|string|max:90|min:2',
                'description' => 'nullable|string|max:255|min:2',
                'status' => 'required|numeric|in:0,1'
            ];
        }
    }
}
