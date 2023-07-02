<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\ApiRequest;

class ShowCategoryRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'with' => ['nullable'],
        ];
    }
}
