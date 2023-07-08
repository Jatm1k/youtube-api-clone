<?php

namespace App\Http\Requests\Comment;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'text' => ['required', 'string'],
            'video_id' => ['required_without:comment_id', 'int', 'exists:videos,id'],
            'comment_id' => ['nullable', 'int', 'exists:comments,id'],
        ];
    }
}
