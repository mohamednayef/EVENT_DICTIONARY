<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Enums\Category as CategoryEnum;

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
            'category_id' => Category::inRandomOrder()->value('id'),
            'category' => fake()->randomElement(CategoryEnum::cases())->value,
            'name' => Str::random(10),
            'description' => Str::random(100),
            'date' => fake()->dateTimeBetween('-1 year', '+1 year'),
            'location' => fake()->address(),
            'capacity' => $capacity = fake()->numberBetween(200, 5000),
            'available_tickets' => fake()->numberBetween(0, $capacity),
        ];
    }
}
