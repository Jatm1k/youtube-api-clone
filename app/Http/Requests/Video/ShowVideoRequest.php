<?php

namespace App\Http\Requests\Video;

use App\Http\Requests\ApiRequest;

class ShowVideoRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'with' => ['nullable'],
        ];
    }
}
