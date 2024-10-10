<?php

namespace Database\Seeders;

use App\Models\Weighbridge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeighbridgeSeeder extends Seeder
{
    public function run(): void
    {
        if (Weighbridge::count() == 0) {

            $data = [];

            // Type 1: G-1 to G-13
            for ($i = 1; $i <= 13; $i++) {
                $data[] = [
                    'type'        => 1,
                    'name'        => 'G-' . $i,
                    'slug'        => 'g-' . $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Type 2: A-1 to A-5
            for ($i = 1; $i <= 5; $i++) {
                $data[] = [
                    'type'        => 2,
                    'name'        => 'A-' . $i,
                    'slug'        => 'a-' . $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            Weighbridge::insert($data);
        }
    }
}

