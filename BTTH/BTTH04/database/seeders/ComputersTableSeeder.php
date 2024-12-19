<?php
namespace Database\Seeders;
use App\Models\Computer;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ComputersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 20) as $index) {
            DB::table('computers')->insert([
                'computer_name' => $faker->word . '-' . $faker->randomNumber(2),
                'model' => $faker->word . ' ' . $faker->randomNumber(4),
                'operating_system' => 'Windows ' . $faker->randomElement(['10', '11', '8']),
                'processor' => 'Intel Core i' . $faker->randomElement(['3', '5', '7']) . '-' . $faker->randomNumber(5),
                'memory' => $faker->randomElement([4, 8, 16, 32]),
                'available' => $faker->boolean,
            ]);
        }
    }
}
