<?php

namespace Database\Factories;

use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = $this->createdAt();

        return [
            'title' => ucfirst(fake()->words(rand(3,6), true)),
            'description' => fake()->sentences(rand(2, 5), true),
            'channel_id' => Channel::inRandomOrder()->first()->id,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }

    private function createdAt()
    {
        $period = fake()->randomElement(['year', 'month', 'week', 'day', 'hour']);
        return fake()->dateTimeBetween("-1 $period");
    }
}
