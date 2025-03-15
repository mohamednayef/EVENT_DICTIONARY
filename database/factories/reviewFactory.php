<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'event_id' => $this->faker->numberBetween(1,39),
            'ticket_type' => $this->faker->randomElement(['regular', 'VIP']),
            'price' => $this->faker->randomFloat(2, 100, 5000),
            'quantity' => $this->faker->numberBetween(100, 5000),
        ];
    }
}
