<?php

namespace App\Http\Requests\User\Forum;

use Illuminate\Foundation\Http\FormRequest;

class ForumCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:200',
            'sub_category_id' => 'required|numeric|exists:categories,id',
            'description' => 'required|string|max:2000|min:5',
//            'tags' => 'nullable|array',
        ];
    }
}
