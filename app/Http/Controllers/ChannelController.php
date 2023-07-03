<?php

namespace App\Http\Controllers;

use App\Enums\Period;
use App\Http\Requests\Channel\IndexChannelRequest;
use App\Http\Requests\Channel\ShowChannelRequest;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexChannelRequest $request)
    {
        return Channel::query()
            ->withRelationships($request->input('with', []))
            ->search($request->input('query'))
            ->orderBy($request->input('sort', 'name'), $request->input('order', 'asc'))
            ->simplePaginate($request->input('limit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Channel::query()->create([

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowChannelRequest $request, Channel $channel)
    {
        return $channel->load($request->input('with', []));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Channel $channel)
    {
        $channel->update([

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Channel $channel)
    {
        $channel->delete();
    }
}
