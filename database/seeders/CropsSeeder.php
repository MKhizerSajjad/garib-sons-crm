<?php

namespace Database\Seeders;
use App\Models\Crop;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CropsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Crop::count() == 0) {

            $data = [
                [
                    'name'        => 'Rice',
                    'slug'        => 'rice',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Wheat',
                    'slug'        => 'wheat',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Corn',
                    'slug'        => 'corn',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            Crop::insert($data);
        }
    }
}
