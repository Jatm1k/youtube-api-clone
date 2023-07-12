<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {

        if (!Auth::attempt($request->validated())) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }

        return response()->json([
            'token' => auth()->user()->createToken('auth_token', ['comment:update', 'comment:destroy'])->plainTextToken,
        ]);
    }

    public function register(RegisterRequest $request)
    {
        return User::query()->create($request->validated());
    }

    public function logout(Request $request)
    {
        return $request->user()->currentAccessToken()->delete();
    }

    public function destroy(Request $request)
    {
        return $request->user()->delete();
    }
}
