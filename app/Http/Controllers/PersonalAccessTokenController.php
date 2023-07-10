<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonalAccessTokenRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PersonalAccessTokenController extends Controller
{
    public function store(StorePersonalAccessTokenRequest $request)
    {
        $user = User::query()->where('email', $request->input('email'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }

        return response()->json([
            'token' => $user->createToken($request->input('device_name'))->plainTextToken,
        ]);
    }
}
