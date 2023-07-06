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
    public function configure()
    {
        return $this->afterCreating(function (Comment $comment) {
            if ($comment->replies()->exists()) return;

            $comment->parent()->associate($this->findParentComment($comment))->save();
        });
    }
    public function definition(): array
    {
        return [
            'text' => fake()->sentences(rand(1, 8), true),
            'user_id' => User::inRandomOrder()->first()->id,
            'video_id' => Video::inRandomOrder()->first()->id,
        ];
    }

    private function findParentComment(Comment $comment)
    {
        return $comment->video->comments()->doesntHave('parent')
            ->where('id', '<>', $comment->id)
            ->inRandomOrder()
            ->first();
    }
}
