<?php

namespace Database\Seeders;

use App\Models\Library;
use App\Models\Book;
use App\Models\Renter;
use App\Models\Laptop;
use App\Models\ITCenter;
use App\Models\HardwareDevice;
use App\Models\Cinema;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database
     */
    public function run(): void
    {
        // Seed libraries and books
        Library::factory(5)->create()->each(function ($library) {
            Book::factory(rand(3, 10))->create([
                'library_id' => $library->id,
            ]);
        });

        // Seed renters and laptops
        Renter::factory(10)->create()->each(function ($renter) {
            Laptop::factory(rand(1, 5))->create([
                'renter_id' => $renter->id,
            ]);
        });

        // Seed IT centers and hardware devices
        ITCenter::factory(5)->create()->each(function ($itCenter) {
            HardwareDevice::factory(rand(5, 10))->create([
                'center_id' => $itCenter->id,
            ]);
        });

        // Seed cinemas and movies
        Cinema::factory(3)->create()->each(function ($cinema) {
            Movie::factory(rand(5, 10))->create([
                'cinema_id' => $cinema->id,
            ]);
        });
    }
}
