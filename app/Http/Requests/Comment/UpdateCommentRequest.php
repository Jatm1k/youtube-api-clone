<?php

namespace App\Http\Requests\Comment;

use App\Http\Requests\ApiRequest;

class UpdateCommentRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'text' => ['required', 'string'],
        ];
    }
}
