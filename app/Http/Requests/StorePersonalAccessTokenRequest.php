<?php

namespace App\Http\Requests;


class StorePersonalAccessTokenRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'device_name' => ['required', 'string'],
        ];
    }
}
