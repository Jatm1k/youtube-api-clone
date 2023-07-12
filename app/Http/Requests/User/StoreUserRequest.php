<?php

namespace App\Http\Requests\User;


use App\Http\Requests\ApiRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', Password::default()],
        ];
    }
}
