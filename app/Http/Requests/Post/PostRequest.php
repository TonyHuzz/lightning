<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:80'],
            'content' => ['required'],
            'thumbnail' => ['nullable', 'image', 'max:5120'],
            'is_published' => ['nullable', 'boolean'],
        ];
    }
}
