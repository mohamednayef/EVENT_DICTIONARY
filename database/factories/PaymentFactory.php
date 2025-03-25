<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1,39),
            'event_id' => fake()->numberBetween(1,39),
            'nu_of_tickets' => fake()->numberBetween(1, 10),
            'total_price' => fake()->randomFloat(2, 500, 5000),
            'payment_method' => fake()->randomElement(PaymentMethod::cases())->value,
            'payment_status' => fake()->randomElement(PaymentStatus::cases())->value,
        ];
    }
}
