<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classes>
 */
class ClassesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'grade_level' => $this->faker->randomElement(['Pre-K', 'Kindergarten']),
            'room_number' => $this->faker->regexify('[A-Z]{2}[0-9]{1,2}'),
        ];
    }
}
