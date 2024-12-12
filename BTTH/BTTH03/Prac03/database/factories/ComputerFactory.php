<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ComputerFactory extends Factory
{
    public function definition()
    {
        return [
            'computer_name' => $this->faker->word(),
            'model' => $this->faker->word(),
            'operating_system' => $this->faker->randomElement(['Windows 10 Pro', 'Ubuntu 22.04', 'macOS Monterey']),
            'processor' => $this->faker->randomElement(['Intel Core i5', 'Intel Core i7', 'AMD Ryzen 5']),
            'memory' => $this->faker->numberBetween(4, 64),
            'available' => $this->faker->boolean(),
        ];
    }
}
