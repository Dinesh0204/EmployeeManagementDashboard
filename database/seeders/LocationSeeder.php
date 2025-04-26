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
        $locationData = ['Mumbai', 'Pune', 'Nashik', 'Hyderabad', 'Bengaluru'];

        $locations = array_map(function ($location) {
            return [
                'name' => $location,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }, $locationData);

        Location::insert($locations);
    }
}
