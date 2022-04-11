<?php

namespace App\Http\Requests\User\Forum;

use Illuminate\Foundation\Http\FormRequest;

class ForumCommentCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return loggedUser()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'comment' => 'required|max:255',
        ];
    }
}
