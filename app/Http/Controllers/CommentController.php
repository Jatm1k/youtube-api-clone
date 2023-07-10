<?php

namespace App\Http\Controllers;

use App\Enums\Period;
use App\Http\Requests\Comment\IndexCommentRequest;
use App\Http\Requests\Comment\ShowCommentRequest;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexCommentRequest $request)
    {
        return Comment::query()
            ->withRelationships($request->input('with'))
            ->orderBy($request->input('sort', 'created_at'), $request->input('order', 'desc'))
            ->simplePaginate($request->input('limit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        return Comment::query()->create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowCommentRequest $request, Comment $comment)
    {
        return $comment->loadRelationships($request->input('with'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        Gate::allowIf(fn(User $user) => $comment->isOwnedBy($user));
        return $comment->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        Gate::allowIf(fn(User $user) => $comment->isOwnedBy($user));
        return $comment->delete();
    }

}
