<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
// use App\Models\Bookmark;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bookmark>
 */
class BookmarkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1,39),
            'event_id' => $this->faker->numberBetween(1,39),
        ];
    }
}
