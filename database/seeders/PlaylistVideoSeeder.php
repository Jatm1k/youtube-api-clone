<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Channel;
use App\Models\Playlist;
use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PlaylistVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Playlist::all()
            ->each(fn(Playlist $playlist) => $playlist->videos()->saveMany($this->randomVideosFrom($playlist->channel)));
    }

    private function randomVideosFrom(Channel $channel)
    {
        return $channel->videos->whenEmpty(
            fn() => collect(),
            fn($videos) => $videos->random(rand(1, count($videos)))
        );
    }
}
