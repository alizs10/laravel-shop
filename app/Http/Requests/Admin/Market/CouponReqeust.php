<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CouponReqeust extends FormRequest
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
            'code' => 'required|string|min:3|max:90',
            'user_id' => (request()->type == 0 ? 'nullable' : 'required|numeric|exists:users,id'),
            'amount_type' => 'required|in:0,1',
            'amount' => 'required|numeric|min:1' . (request()->amount_type == 0 ? '|max:100' : ''),
            "maximum_discount" => 'required|numeric|min:1',
            'type' => 'required|in:0,1',
            'status' => 'required|in:0,1',
            'valid_from' => 'required|digits:13',
            'valid_until' => 'required|digits:13',
        ];
    }
}
