<?php

namespace Database\Seeders;
use App\Models\CropCategory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CropCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (CropCategory::count() == 0) {

            $data = [
                [
                    'name'        => 'Basmati',
                    'slug'        => 'basmati',
                    'crop_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Non Basmati',
                    'slug'        => 'non-basmati',
                    'crop_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];

            CropCategory::insert($data);
        }
    }
}
