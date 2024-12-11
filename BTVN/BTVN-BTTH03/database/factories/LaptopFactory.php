<?php

namespace Database\Factories;

use App\Models\Renter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laptop>
 */
class LaptopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand' => $this->faker->randomElement(['Dell', 'HP', 'Asus', 'Lenovo', 'Apple']),
            'model' => $this->faker->word() . ' ' . $this->faker->randomNumber(4),
            'specifications' => $this->faker->randomElement(['i5, 8GB RAM, 256GB SSD', 'i7, 16GB RAM, 512GB SSD', 'Ryzen 5, 8GB RAM, 1TB HDD']),
            'rental_status' => $this->faker->boolean(),
            'renter_id' => Renter::factory()->create()->id,
        ];
    }
}
