<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'category_id' => function () {
                return \App\Models\Category::factory()->create()->id;
            },
            'amount' => fake()->randomFloat(2, 0, 1000),
            'description' => fake()->sentence,
            'date' => fake()->date,
        ];
    }
}
