<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\ShowUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateProfileUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexUserRequest $request)
    {
        return User::query()
            ->withRelationships($request->input('with'))
            ->search($request->input('query'))
            ->orderBy($request->input('sort', 'name'), $request->input('order', 'asc'))
            ->simplePaginate($request->input('limit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::query()->create($request->validated());

        event(new Registered($user));

        Auth::login($user);

        return response([
            'message' => 'Thanks for signing up! Before getting started, could you verify your email.'
        ], Response::HTTP_CREATED);
    }

    public function showProfile(Request $request)
    {
        return response(auth()->user());
    }

    public function updateProfile(UpdateProfileUserRequest $request)
    {
        $request->user()->update($request->validated());

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowUserRequest $request, User $user)
    {
        return $user->loadRelationships($request->input('with'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = $request->user();
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $user->delete();

        return response()->noContent();
    }
}
