<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\Unique;

class UpdateProfileUserRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string'],
            'email' => ['string', 'email', Rule::unique('users')->ignore(auth()->id())],
            'password' => ['string', Password::default()],
        ];
    }
}
