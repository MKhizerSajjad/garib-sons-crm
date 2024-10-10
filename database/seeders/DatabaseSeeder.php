<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CountriesTableSeeder::class,
            StatesTableSeeder::class,
            CitiesTableChunkOneSeeder::class,
            CitiesTableChunkTwoSeeder::class,
            CitiesTableChunkThreeSeeder::class,
            CitiesTableChunkFourSeeder::class,
            CitiesTableChunkFiveSeeder::class,
            CropsSeeder::class,
            CropTypesSeeder::class,
            CropYearsSeeder::class,
            CropCategoriesSeeder::class,
            CropItemsSeeder::class,
            SupplierSeeder::class,
            LocationSeeder::class,
            WeighbridgeSeeder::class,
        ]);
    }
}
