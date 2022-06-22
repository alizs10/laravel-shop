<?php

namespace App\Http\Requests\app;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
        $user = auth()->user();
        return [
            'first_name' => 'required|string|min:3|max:50',
            'last_name' => 'required|string|min:3|max:90',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'mobile' => 'required|digits:11|unique:users,mobile,'.$user->id,
            'national_code' => 'required|digits:10',
        ];
    }
}
