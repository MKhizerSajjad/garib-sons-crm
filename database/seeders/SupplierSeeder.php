<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;
use App\Models\SupplierAgent;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Supplier::count() == 0) {

            $data = [
                [
                    'name'  => 'Duwaba Mills',
                    'email'   => 'duwaba@gmail.com',
                    'landline'       => '0556810020',
                    'phone'       => '+923094118700',
                    'country_id'    => 1,
                    'state_id'    => 1,
                    'city_id'    => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'  => 'AD Traders',
                    'email'   => 'adtrraders@gmail.com',
                    'landline'       => '0556810040',
                    'phone'       => '+923094118400',
                    'country_id'    => 1,
                    'state_id'    => 1,
                    'city_id'    => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];

            Supplier::insert($data);
        }

        if (SupplierAgent::count() == 0) {

            $data = [
                [
                    'name'  => 'Mubassar Aslam',
                    'email'   => 'mubassar@gmail.com',
                    'landline'       => '0556810020',
                    'phone'       => '+923094118700',
                    'address'    => "",
                    'supplier_id'    => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name'  => 'Ali Raza',
                    'email'   => 'ali@gmail.com',
                    'landline'       => '0556810040',
                    'phone'       => '+923094118200',
                    'address'    => "",
                    'supplier_id'    => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];

            SupplierAgent::insert($data);
        }
    }
}
