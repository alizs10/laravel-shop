<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
                'marketable_number' => 'required|numeric|min:1',
                'description' => 'required|string|max:255',
                'receiver' => 'required|string|max:90',
                'deliverer' => 'required|string|max:90',
            ];
        } else {
            return [
                'marketable_number' => 'required|numeric|min:0',
                'frozen_number' => 'required|numeric|min:0',
                'sold_number' => 'required|numeric|min:0',
            ];
        }
    }
}
