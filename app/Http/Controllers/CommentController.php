<?php

namespace App\Http\Controllers;

use App\Enums\Period;
use App\Http\Requests\Comment\IndexCommentRequest;
use App\Http\Requests\Comment\ShowCommentRequest;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Models\Comment;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

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
        $attributes = $request->validated();

        if ($request->input('comment_id')) {
            $attributes['video_id'] = Comment::query()->find($request->input('comment_id'))->video_id;
        }

        $attributes['user_id'] = auth()->id();

        return Comment::query()->create($attributes);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowCommentRequest $request, Comment $comment)
    {
        return $comment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        throw_if($request->user()->isNot($comment->user), AuthorizationException::class);
        return $comment->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
