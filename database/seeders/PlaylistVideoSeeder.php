<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $videoIds = Video::query()->pluck('id');
        $playlistIds = Playlist::query()->pluck('id');

        $playlistVideos = $playlistIds->flatMap(
            fn ($playlistId) => $this->playlistVideos($playlistId, $this->randomVideoIds($videoIds))
        );

        DB::table('playlist_video')->insert($playlistVideos->all());
    }

    private function playlistVideos(int $playlistId, $videoIds)
    {
        return $videoIds->map(fn ($videoId) => [
                'playlist_id' => $playlistId,
                'video_id' => $videoId,
            ]
        );
    }

    private function randomVideoIds($videoIds)
    {
        return $videoIds->random(rand(1, count($videoIds)));
    }
}
