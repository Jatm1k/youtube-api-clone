<?php

namespace App\Http\Controllers;

use App\Enums\Period;
use App\Http\Requests\Video\IndexVideoRequest;
use App\Http\Requests\Video\ShowVideoRequest;
use App\Models\Video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexVideoRequest $request)
    {
        return Video::query()
            ->with($request->input('with', []))
            ->fromPeriod(Period::tryFrom($request->input('period')))
            ->search($request->input('query'))
            ->orderBy($request->input('sort', 'created_at'), $request->input('order', 'desc'))
            ->simplePaginate($request->input('limit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Video::query()->create([]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowVideoRequest $request, Video $video)
    {
        return $video->load($request->input('with', []));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        $video->update([]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        $video->delete();
    }
}
