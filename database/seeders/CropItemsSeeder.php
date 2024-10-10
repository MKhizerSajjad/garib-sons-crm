<?php

namespace Database\Seeders;
use App\Models\CropItem;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CropItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (CropItem::count() == 0) {

            $data = [
                [
                    'name'        => 'Super',
                    'slug'        => 'super',
                    'crop_id'     => 1,
                    'crop_category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => '1121',
                    'slug'        => '1121',
                    'crop_id'     => 1,
                    'crop_category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => '1509',
                    'slug'        => '1509',
                    'crop_id'     => 1,
                    'crop_category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Super Chanab',
                    'slug'        => 'super-chanab',
                    'crop_id'     => 1,
                    'crop_category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'D-98',
                    'slug'        => 'd-98',
                    'crop_id'     => 1,
                    'crop_category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Irri-6',
                    'slug'        => 'irri-6',
                    'crop_id'     => 1,
                    'crop_category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'C-9',
                    'slug'        => 'c-9',
                    'crop_id'     => 1,
                    'crop_category_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Super Fine',
                    'slug'        => 'super-fine',
                    'crop_id'     => 1,
                    'crop_category_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => '386',
                    'slug'        => '386',
                    'crop_id'     => 1,
                    'crop_category_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Lal 386',
                    'slug'        => 'lal-386',
                    'crop_id'     => 1,
                    'crop_category_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Supri',
                    'slug'        => 'supri',
                    'crop_id'     => 1,
                    'crop_category_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

            ];

            CropItem::insert($data);
        }
    }
}
