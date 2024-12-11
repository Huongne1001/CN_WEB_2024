<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Library>
 */
class LibraryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Library', // Tên thư viện
            'address' => $this->faker->address, // Địa chỉ
            'contact_number' => $this->faker->phoneNumber, // Số điện thoại liên hệ
        ];
    }
}
