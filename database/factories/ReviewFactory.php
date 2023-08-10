<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'rating' => fake()->numberBetween(0,5),
            'comment' => implode(' ', fake()->words(rand(10,100))),
            'reviewed_on' => fake()->dateTimeBetween('-6 months', '+1 week'),
        ];
    }
}
