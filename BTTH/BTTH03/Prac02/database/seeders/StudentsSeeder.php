<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Students;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = Classes::all();

        $classes->each(function ($class) {
            Students::factory(rand(10, 20))->create([
                'class_id' => $class->id, // Liên kết học sinh với lớp
            ]);
        });
    }
}
