<?php

namespace App\Http\Requests\Video;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexVideoRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'period' => ['nullable', 'string', Rule::in(['year', 'month', 'week', 'day', 'hour'])],
            'query' => ['nullable', 'string'],
        ];
    }
}
