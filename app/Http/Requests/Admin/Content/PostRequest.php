<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
                'title' => 'required|max:255|min:2',
                'summary' => 'required|max:500|min:2',
                'body' => 'required|min:2',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|max:255|min:2',
                'commentable' => 'required',
                'published_at' => 'required|digits:13',
                'cat_id' => 'required|exists:App\Models\Content\PostCategory,id',
                'commentable' => 'required|numeric|in:0,1',
                'image' => 'required|image|mimes:jpg,jpeg,png',
            ];
        }
        else {
            return [
                'title' => 'required|max:255|min:2',
                'summary' => 'required|max:500|min:2',
                'body' => 'required|min:2',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'required|max:255|min:2',
                'commentable' => 'required',
                'published_at' => 'required|digits:13',
                'cat_id' => 'required|exists:App\Models\Content\PostCategory,id',
                'commentable' => 'required|numeric|in:0,1',
                'image' => 'nullable|image|mimes:jpg,jpeg,png',
            ];
        }
    }
}
