<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\TicketStatus;
use App\Enums\TicketType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
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
            'type' => fake()->randomElement(TicketType::cases())->value,
            'status' => fake()->randomElement(TicketStatus::cases())->value,
            'price' => fake()->randomFloat(2, 100, 5000),
        ];
    }
}
