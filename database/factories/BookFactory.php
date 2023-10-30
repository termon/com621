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
            'slug' => str($title)->slug(),            
            'year' => fake()->numberBetween(2010,2023),
            'rating' => 0, //fake()->numberBetween(0,5),
            'description' => fake()->words(50, true),
            'image' => "data:image/webp;base64,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"
        ];
    }
}
