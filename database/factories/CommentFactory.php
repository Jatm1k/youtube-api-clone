<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'text' => fake()->sentences(rand(1, 8), true),
            'user_id' => User::inRandomOrder()->first()->id ?: User::factory(),
            'video_id' => Video::inRandomOrder()->first()->id ?: Video::factory(),
        ];
    }

    public function reply()
    {
        return $this->state(fn ($attributes) => ['comment_id' => Video::inRandomOrder()->first()->id ?: Video::factory()]);
    }

}
