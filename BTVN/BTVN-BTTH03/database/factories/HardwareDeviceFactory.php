<?php

namespace Database\Factories;

use App\Models\ITCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HardwareDevice>
 */
class HardwareDeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'device_name' => $this->faker->word() . ' ' . $this->faker->randomNumber(3),
            'type' => $this->faker->randomElement(['Mouse', 'Keyboard', 'Headset', 'Monitor']),
            'status' => $this->faker->boolean(),
            'center_id' => ITCenter::factory(),
        ];
    }
}
