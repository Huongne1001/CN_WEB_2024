<?php
namespace Database\Factories;

use App\Models\Computer;
use Illuminate\Database\Eloquent\Factories\Factory;

class IssueFactory extends Factory
{
    public function definition()
    {
        return [
            'computer_id' => Computer::factory(),
            'reported_by' => $this->faker->name(),
            'reported_date' => $this->faker->dateTime(),
            'description' => $this->faker->text(),
            'urgency' => $this->faker->randomElement(['Low', 'Medium', 'High']),
            'status' => $this->faker->randomElement(['Open', 'In Progress', 'Resolved']),
        ];
    }
}
