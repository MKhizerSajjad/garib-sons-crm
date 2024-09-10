<?php

namespace Database\Seeders;
use App\Models\Category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Category::count() == 0) {

            $data = [
                [
                    'name'        => 'Rice',
                    'slug'        => 'rice',
                    'category_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Basmati',
                    'slug'        => 'basmati',
                    'category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Non Basmati',
                    'slug'        => 'non-basmati',
                    'category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Wheat',
                    'slug'        => 'wheat',
                    'category_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Corn',
                    'slug'        => 'corn',
                    'category_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];

            Category::insert($data);
        }
    }
}
