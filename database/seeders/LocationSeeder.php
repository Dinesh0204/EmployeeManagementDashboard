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
        $locationData = [
            ['name' => 'Mumbai', 'latitude' => 19.0760, 'longitude' => 72.8777],
            ['name' => 'Pune', 'latitude' => 18.5204, 'longitude' => 73.8567],
            ['name' => 'Nashik', 'latitude' => 19.9975, 'longitude' => 73.7898],
            ['name' => 'Hyderabad', 'latitude' => 17.3850, 'longitude' => 78.4867]
        ];


        $locations = array_map(function ($location) {
            return [
                'name' => $location['name'],
                'latitude' => $location['latitude'],
                'longitude' => $location['longitude'],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }, $locationData);

        Location::insert($locations);
    }
}
