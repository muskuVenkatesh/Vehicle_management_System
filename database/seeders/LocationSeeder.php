<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            ['location_name' => 'Hyderabad Airport', 'address' => 'Shamshabad', 'city' => 'Hyderabad', 'state' => 'Telangana', 'zip_code' => '500409', 'latitude' => 17.2403, 'longitude' => 78.4294],
            ['location_name' => 'Charminar', 'address' => 'Char Kaman', 'city' => 'Hyderabad', 'state' => 'Telangana', 'zip_code' => '500002', 'latitude' => 17.3616, 'longitude' => 78.4747],
            ['location_name' => 'Hitech City', 'address' => 'Madhapur', 'city' => 'Hyderabad', 'state' => 'Telangana', 'zip_code' => '500081', 'latitude' => 17.4504, 'longitude' => 78.3809],
            ['location_name' => 'Warangal Fort', 'address' => 'Warangal', 'city' => 'Warangal', 'state' => 'Telangana', 'zip_code' => '506002', 'latitude' => 17.9784, 'longitude' => 79.5950],
            ['location_name' => 'Nizamabad Railway Station', 'address' => 'Railway Station Rd', 'city' => 'Nizamabad', 'state' => 'Telangana', 'zip_code' => '503001', 'latitude' => 18.6725, 'longitude' => 78.1002],
            ['location_name' => 'Karimnagar Bus Stand', 'address' => 'Karimnagar', 'city' => 'Karimnagar', 'state' => 'Telangana', 'zip_code' => '505001', 'latitude' => 18.4386, 'longitude' => 79.1288],
            ['location_name' => 'Khammam Railway Station', 'address' => 'Khammam', 'city' => 'Khammam', 'state' => 'Telangana', 'zip_code' => '507001', 'latitude' => 17.2473, 'longitude' => 80.1437],
            ['location_name' => 'Adilabad Bus Stand', 'address' => 'Adilabad', 'city' => 'Adilabad', 'state' => 'Telangana', 'zip_code' => '504001', 'latitude' => 19.6742, 'longitude' => 78.5320],
            ['location_name' => 'Medak Church', 'address' => 'Medak', 'city' => 'Medak', 'state' => 'Telangana', 'zip_code' => '502110', 'latitude' => 18.0344, 'longitude' => 78.2625],
            ['location_name' => 'Jagitial Fort', 'address' => 'Jagitial', 'city' => 'Jagitial', 'state' => 'Telangana', 'zip_code' => '505327', 'latitude' => 18.8000, 'longitude' => 78.9167],
            ['location_name' => 'Siddipet Bus Stand', 'address' => 'Siddipet', 'city' => 'Siddipet', 'state' => 'Telangana', 'zip_code' => '502103', 'latitude' => 18.0995, 'longitude' => 78.8520],
            ['location_name' => 'Mahbubnagar Railway Station', 'address' => 'Mahbubnagar', 'city' => 'Mahbubnagar', 'state' => 'Telangana', 'zip_code' => '509001', 'latitude' => 16.7375, 'longitude' => 77.9845],
            ['location_name' => 'Ramoji Film City', 'address' => 'Abdullahpurmet', 'city' => 'Hyderabad', 'state' => 'Telangana', 'zip_code' => '501512', 'latitude' => 17.2543, 'longitude' => 78.6826],
            ['location_name' => 'Sangareddy District HQ', 'address' => 'Sangareddy', 'city' => 'Sangareddy', 'state' => 'Telangana', 'zip_code' => '502001', 'latitude' => 17.6158, 'longitude' => 78.0865],
            ['location_name' => 'Bhongir Fort', 'address' => 'Bhongir', 'city' => 'Bhongir', 'state' => 'Telangana', 'zip_code' => '508116', 'latitude' => 17.5124, 'longitude' => 78.8850],
            ['location_name' => 'Vemulawada Temple', 'address' => 'Vemulawada', 'city' => 'Vemulawada', 'state' => 'Telangana', 'zip_code' => '505302', 'latitude' => 18.4643, 'longitude' => 78.8684],
            ['location_name' => 'Sircilla Textile Park', 'address' => 'Sircilla', 'city' => 'Sircilla', 'state' => 'Telangana', 'zip_code' => '505301', 'latitude' => 18.3830, 'longitude' => 78.8015],
            ['location_name' => 'Peddapalli Bus Stand', 'address' => 'Peddapalli', 'city' => 'Peddapalli', 'state' => 'Telangana', 'zip_code' => '505172', 'latitude' => 18.6157, 'longitude' => 79.3741],
            ['location_name' => 'Mancherial Railway Station', 'address' => 'Mancherial', 'city' => 'Mancherial', 'state' => 'Telangana', 'zip_code' => '504208', 'latitude' => 18.8776, 'longitude' => 79.4498],
            ['location_name' => 'Nalgonda Bus Stand', 'address' => 'Nalgonda', 'city' => 'Nalgonda', 'state' => 'Telangana', 'zip_code' => '508001', 'latitude' => 17.0565, 'longitude' => 79.2686],
            ['location_name' => 'Nagarkurnool Bus Stand', 'address' => 'Nagarkurnool', 'city' => 'Nagarkurnool', 'state' => 'Telangana', 'zip_code' => '509209', 'latitude' => 16.4825, 'longitude' => 78.3132],
        ];

        DB::table('locations')->insert($locations);
    }
}
