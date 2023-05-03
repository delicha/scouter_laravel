<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evaluation>
 */
class EvaluationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween($min = 1, $max = 30),
            'target_user_id' => fake()->numberBetween($min = 1, $max = 30),
            'evaluation_point' => fake()->numberBetween($min = 0, $max = 10),
        ];
    }
}
