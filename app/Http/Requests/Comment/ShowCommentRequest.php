<?php

namespace App\Http\Requests\Comment;

use App\Http\Requests\ApiRequest;

class ShowCommentRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'with' => ['nullable'],
        ];
    }
}
