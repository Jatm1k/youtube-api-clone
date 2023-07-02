<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use Illuminate\Validation\Rule;

class IndexUserRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'query' => ['nullable', 'string'],
            'limit' => ['nullable', 'int'],
            'sort' => ['nullable', 'string'],
            'order' => ['nullable', 'string', Rule::in(['desc', 'asc'])],
            'with' => ['nullable'],
        ];
    }
}
