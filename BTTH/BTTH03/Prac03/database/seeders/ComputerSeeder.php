<?php
namespace Database\Seeders;

use App\Models\Computer;
use Illuminate\Database\Seeder;

class ComputerSeeder extends Seeder
{
    public function run()
    {
        // Tạo 10 máy tính
        Computer::factory(10)->create();
    }
}
