<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartment>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address' => fake()->address(),
            'city' => fake()->city(),
            'postal_code' => fake()->randomNumber(5, true),
            'rented_price' => fake()->numberBetween(350, 10000),
            'rented' => fake()->boolean(),
            'user_id' => User::all()->random()->id
        ];
    }
}
