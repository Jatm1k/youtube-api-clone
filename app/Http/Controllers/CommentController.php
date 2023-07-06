<?php

namespace App\Http\Controllers;

use App\Enums\Period;
use App\Http\Requests\Comment\IndexCommentRequest;
use App\Http\Requests\Comment\ShowCommentRequest;
use App\Models\Comment;
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
