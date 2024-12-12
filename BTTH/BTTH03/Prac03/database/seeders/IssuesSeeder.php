<?php
namespace Database\Seeders;

use App\Models\Issue;
use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    public function run()
    {
        // Tạo 30 vấn đề cho máy tính
        Issue::factory(30)->create();
    }
}
