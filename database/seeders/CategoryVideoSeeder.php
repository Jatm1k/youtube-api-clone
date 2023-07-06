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
        $videos = Video::all();
        Category::all()
            ->each(fn(Category $category) => $category->videos()->saveMany($this->randomVideos($videos)));
    }

    private function randomVideos($videos)
    {
        return $videos->random(rand(1, 5));
    }
}
