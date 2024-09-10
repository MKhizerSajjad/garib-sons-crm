<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Location::count() == 0) {

            $data = [
                [
                    'name'  => 'Port Qasim',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'  => 'Golarchi',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];

            Location::insert($data);
        }
    }
}
