<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("sales")->insert([
            [
                'medicine_id'=> 1,
                'quantity'=> 5,
                'sale_date'=> Carbon::now(),
                'customer_phone'=> '0569198435',
            ],
            [
                'medicine_id'=> 2,
                'quantity'=> 3,
                'sale_date'=> Carbon::now(),
                'customer_phone'=> '057485847',
            ]


        ]);
    }
}
