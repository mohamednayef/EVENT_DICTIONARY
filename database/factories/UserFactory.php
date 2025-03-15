<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\str;
use App\Enums\Gender;
use App\Enums\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    
    // protected $model = User::class;
    
    // The current password being used by the factory.
    protected static ?string $password;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fname' => $this->faker->firstName(),
            'lname' => $this->faker->lastName(),
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'phone' => $this->faker->numerify('010########'),
            'gender' => $this->faker->randomElement(Gender::cases())->value,
            'role' => $this->faker->randomElement(Role::cases())->value,
            'remember_token' => Str::random(10),
        ];
    }

    // Indicate that the model's email address should be unverified.
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
