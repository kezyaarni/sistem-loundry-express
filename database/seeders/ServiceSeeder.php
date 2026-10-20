<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
        [    
            'service_name' => 'Cuci',
            'category' => 'Kiloan',
            'price_per_unit' => 7000,
            'unit_type' => 'Kg',
            'description' => 'Cuci + setrika, selesai 2-3'
        ],
        [
            'service_name' => 'Cuci Kering Lipat',
            'category' => 'Kiloan',
            'price_per_unit' => 5000,
            'unit_type' => 'Kg',
            'description' => 'Cuci dan lipat tanpa setrika'
        ], 
        [
            'service_name' => 'Dry Cleaning Jaz/Dress',
            'category' => 'Satuan',
            'price_per_unit' => 35000,
            'unit_type' => 'Pcs',
            'description' => 'Jaz, Blezer, dan Dress'
        ],
        [
            'service_name' => 'Bed Cover',
            'category' => 'Satuan',
            'price_per_unit' => 25000,
            'unit_type' => 'Pcs',
            'description' => 'Bed cover dan selimut tebal'
        ],
        [
            'service_name' => 'Express 6',
            'category' => 'Satuan',
            'price_per_unit' => 15000,
            'unit_type' => 'Kg',
            'description' => 'Cuci & setrika dalam 6 jam'
        ],
        ];

        foreach($services as $service){
            Service::create($service);
        }
    }
}
