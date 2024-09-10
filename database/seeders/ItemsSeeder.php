<?php

namespace Database\Seeders;
use App\Models\Item;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Item::count() == 0) {

            $data = [
                [
                    'name'        => 'Super',
                    'slug'        => 'super',
                    'category_id' => 1,
                    'sub_category_id' => 2,
                    'item_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => '1121',
                    'slug'        => '1121',
                    'category_id' => 1,
                    'sub_category_id' => 2,
                    'item_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => '1509',
                    'slug'        => '1509',
                    'category_id' => 1,
                    'sub_category_id' => 2,
                    'item_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Super Chanab',
                    'slug'        => 'super-chanab',
                    'category_id' => 1,
                    'sub_category_id' => 2,
                    'item_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'D-98',
                    'slug'        => 'd-98',
                    'category_id' => 1,
                    'sub_category_id' => 2,
                    'item_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Irri-6',
                    'slug'        => 'irri-6',
                    'category_id' => 1,
                    'sub_category_id' => 2,
                    'item_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'C-9',
                    'slug'        => 'c-9',
                    'category_id' => 1,
                    'sub_category_id' => 3,
                    'item_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Super Fine',
                    'slug'        => 'super-fine',
                    'category_id' => 1,
                    'sub_category_id' => 3,
                    'item_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => '386',
                    'slug'        => '386',
                    'category_id' => 1,
                    'sub_category_id' => 3,
                    'item_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Lal 386',
                    'slug'        => 'lal-386',
                    'category_id' => 1,
                    'sub_category_id' => 3,
                    'item_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Supri',
                    'slug'        => 'supri',
                    'category_id' => 1,
                    'sub_category_id' => 3,
                    'item_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'name'        => 'Raw (23-24)',
                    'slug'        => 'raw(23-24)',
                    'category_id' => 1,
                    'sub_category_id' => 2,
                    'item_id' => 1,
                    'item_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                [
                    'name'        => 'Raw (24-25)',
                    'slug'        => 'raw(24-25)',
                    'category_id' => 1,
                    'sub_category_id' => 2,
                    'item_id' => 2,
                    'item_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

            ];

            Item::insert($data);
        }
    }
}
