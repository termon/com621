<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(3);
        return [
            'title' => $title,
            'author' => fake()->name(),
            'slug' => str($title)->slug(),            
            'year' => fake()->numberBetween(2010,2023),
            'rating' => fake()->numberBetween(0,5),
            'description' => fake()->words(50, true),
        ];
    }
}
