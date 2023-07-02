<?php

namespace App\Http\Requests\Channel;

use App\Http\Requests\ApiRequest;
use Illuminate\Validation\Rule;

class IndexChannelRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'period' => ['nullable', 'string', Rule::in(['year', 'month', 'week', 'day', 'hour'])],
            'query' => ['nullable', 'string'],
            'limit' => ['nullable', 'int'],
            'sort' => ['nullable', 'string'],
            'order' => ['nullable', 'string', Rule::in(['desc', 'asc'])],
            'with' => ['nullable'],
        ];
    }
}
