<?php

namespace Database\Seeders;

use App\Enums\Period;
use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect(Period::cases())
            ->each(fn(Period $period) => Video::factory(5)->last($period)->create());
    }
}
