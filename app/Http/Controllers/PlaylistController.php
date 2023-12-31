<?php

namespace App\Http\Controllers;

use App\Http\Requests\Playlist\IndexPlaylistRequest;
use App\Http\Requests\Playlist\ShowPlaylistRequest;
use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexPlaylistRequest $request)
    {
        return Playlist::query()
            ->withRelationships($request->input('with'))
            ->search($request->input('query'))
            ->orderBy($request->input('sort', 'name'), $request->input('order', 'asc'))
            ->simplePaginate($request->input('limit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Playlist::query()->create([]);
    }

    /**
     * Display the specified resource.
     */
    public function show (ShowPlaylistRequest $request, Playlist $playlist)
    {
        return $playlist->loadRelationships($request->input('with'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        $playlist->update([]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        $playlist->delete();
    }
}
