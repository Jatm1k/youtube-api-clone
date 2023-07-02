<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;

class ShowUserRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'with' => ['nullable'],
        ];
    }
}
