<?php

namespace Database\Seeders;
use App\Models\CropType;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CropTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (CropType::count() == 0) {

            $data = [
                [
                    'name'        => 'White',
                    'slug'        => 'white',
                    'crop_id'     => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Brown',
                    'slug'        => 'brown',
                    'crop_id'     => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Sela',
                    'slug'        => 'sela',
                    'crop_id'     => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'WhiteSela',
                    'slug'        => 'white-sela',
                    'crop_id'     => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Brown Sela',
                    'slug'        => 'brown-sela',
                    'crop_id'     => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];
            CropType::insert($data);
        }
    }
}
