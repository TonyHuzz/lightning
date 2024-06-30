<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => ['required', 'max:1000'],
        ];
    }

    public function attributes()
    {
        return [
            'content' => '留言',
        ];
    }
}
