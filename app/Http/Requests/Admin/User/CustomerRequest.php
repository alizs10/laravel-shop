<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CustomerRequest extends FormRequest
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
                'first_name' => 'required|string|max:90|min:2',
                'last_name' => 'required|string|max:90|min:2',
                'email' => 'required|email|max:90|unique:users',
                'mobile' => 'required|digits:11|unique:users',
                'national_code' => 'required|digits:10',
                'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols(), 'max:16'],
                'activation' => 'required|numeric|in:0,1',
                'avatar' => 'nullable|image|mimes:jpg,jpeg,png,svg',
            ];
        } else {
            return [
                'first_name' => 'required|string|max:90|min:2',
                'last_name' => 'required|string|max:90|min:2',
                'avatar' => 'nullable|image|mimes:jpg,jpeg,png,svg',
                'national_code' => 'required|digits:10',
            ];
        }
    }
}
