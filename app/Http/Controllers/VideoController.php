<?php

namespace App\Http\Controllers;

use App\Enums\Period;
use App\Http\Requests\Video\IndexVideoRequest;
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
        $period = Period::tryFrom($request->input('period'));

        return Video::query()
            ->fromPeriod($period)
            ->search($request->input('query'))
            ->limit($request->input('limit'))
            ->orderBy($request->input('sort', 'created_at'), $request->input('order', 'desc'))
            ->get();
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
    public function show(Video $video)
    {
        return $video->load(['channel', 'categories']);
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
