<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\BlogStatus;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Blog>
 */
final class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'user_id' => User::factory(),
            'status' => $this->faker->randomElement(array_map(fn ($case) => $case->value, BlogStatus::cases())),
            'details' => $this->faker->paragraph(20),
        ];
    }
}
