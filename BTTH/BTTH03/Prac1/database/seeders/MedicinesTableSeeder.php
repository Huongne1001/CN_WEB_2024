<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("medicines")->insert([
            [
            'name' => 'Paracetamol',
            'brand'=> 'ABC Pharma',
            'dosage'=> '500mg',
            'form'=>'Viên nén',
            'price'=> '10000.00',
            'stock'=> '200',
            ],
            [
                'name' => 'Ibuprofen',
                'brand'=> 'XYZ Pharma',
                'dosage'=> '400mg',
                'form'=>'Viên nén',
                'price'=> '15000.00',
                'stock'=> '150',

            ]


        ]);
    
        //
    }
}
