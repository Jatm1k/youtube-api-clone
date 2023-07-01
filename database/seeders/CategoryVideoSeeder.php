<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CategoryVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videoIds = Video::query()->pluck('id');
        $categoryIds = Category::query()->pluck('id');

        $categoryVideos = $categoryIds->flatMap(
            fn ($categoryId) => $this->categoryVideos($categoryId, $this->randomVideoIds($videoIds))
        );

        DB::table('category_video')->insert($categoryVideos->all());
    }

    private function categoryVideos(int $categoryId, $videoIds)
    {
        return $videoIds->map(fn ($videoId) => [
                'category_id' => $categoryId,
                'video_id' => $videoId,
            ]
        );
    }

    private function randomVideoIds($videoIds)
    {
        return $videoIds->random(rand(1, count($videoIds)));
    }
}
