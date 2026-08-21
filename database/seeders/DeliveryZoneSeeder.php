<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeliveryZone;

class DeliveryZoneSeeder extends Seeder
{
    public function run(): void
    {
        DeliveryZone::create([
            'name' => 'Dhaka',
            'delivery_charge' => 80,
            'free_above' => 2000,
            'estimated_days' => 1,
            'status' => true,
        ]);

        DeliveryZone::create([
            'name' => 'Outside Dhaka',
            'delivery_charge' => 130,
            'free_above' => 3000,
            'estimated_days' => 2,
            'status' => true,
        ]);

        DeliveryZone::create([
            'name' => 'Chittagong',
            'delivery_charge' => 100,
            'free_above' => 2500,
            'estimated_days' => 2,
            'status' => true,
        ]);
    }
}
