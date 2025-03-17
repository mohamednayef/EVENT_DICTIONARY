<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Event;
use App\Enums\Rating;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class reviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'user_id' => $this->faker->numberBetween(1,39),
            // 'event_id' => $this->faker->numberBetween(1,39),
            'user_id' => User::factory(),
            'event_id' => Event::factory(),
            'rating' => fake()->randomElement(Rating::cases())->value,
        ];
    }
}
