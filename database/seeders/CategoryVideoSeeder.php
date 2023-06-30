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
        $videoIds = Video::query()->pluck('id')->all();
        $categoryIds = Category::query()->pluck('id')->all();

        $categoryVideo = [];

        foreach ($categoryIds as $categoryId) {
            $randomVideoIds = Arr::random($videoIds, rand(1, count($videoIds)));

            foreach ($randomVideoIds as $videoId) {
                $categoryVideo[] = [
                    'category_id' => $categoryId,
                    'video_id' => $videoId,
                ];
            }
        }

        DB::table('category_video')->insert($categoryVideo);
    }
}
