<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'title' => $this->faker->sentence(3), // Tên sách
            'author' => $this->faker->name, // Tác giả
            'publication_year' => $this->faker->year, // Năm xuất bản
            'genre' => $this->faker->randomElement(['Programming', 'Algorithms', 'AI', 'Science']), // Thể loại
            'library_id' => null, // Sẽ gán sau trong seeder
        ];
    }
}
