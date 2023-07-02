<?php

namespace App\Http\Requests\Channel;

use App\Http\Requests\ApiRequest;

class ShowChannelRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'with' => ['nullable'],
        ];
    }
}
