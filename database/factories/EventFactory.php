<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Enums\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Str::random(10),
            'descriptoin' => Str::random(100),
            'date' => fake()->dateTimeBetween('-1 year', '+1 year'),
            'category' => fake()->randomElement(Category::cases())->value,
            'location' => fake()->address(),
            'capacity' => $capacity = fake()->numberBetween(200, 5000),
            'available_tickets' => fake()->numberBetween(0, $capacity),
        ];
    }
}
