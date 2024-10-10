<?php

namespace Database\Seeders;
use App\Models\CropYear;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CropYearsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (CropYear::count() == 0) {

            $data = [
                [
                    'name'        => 'Raw (23-24)',
                    'slug'        => 'raw(23-24)',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'        => 'Raw (24-25)',
                    'slug'        => 'raw(24-25)',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            CropYear::insert($data);
        }
    }
}
