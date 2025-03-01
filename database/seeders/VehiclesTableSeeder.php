<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VehiclesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $fuelTypes = ['Petrol', 'Diesel', 'Electric', 'Hybrid'];
        $vehicleTypes = ['Sedan', 'SUV', 'Truck', 'Van', 'Motorcycle'];

        foreach (range(1, 10) as $index) {
            DB::table('vehicles')->insert([
                'make' => $faker->company,
                'model' => $faker->word,
                'year' => $faker->year,
                'vehicle_type' => $faker->randomElement($vehicleTypes),
                'color' => $faker->safeColorName,
                'license_plate' => strtoupper($faker->bothify('??-###-??')),
                'mileage' => $faker->numberBetween(1000, 200000),
                'fuel_type' => $faker->randomElement($fuelTypes),
                'engine_capacity' => $faker->numberBetween(800, 5000) . 'cc',
                'seating_capacity' => $faker->numberBetween(2, 7),
                'availability' => $faker->boolean,
                'daily_rate' => $faker->randomFloat(2, 30, 200),
                'hourly_rate' => $faker->randomFloat(2, 5, 50),
                'image_url' => $faker->imageUrl(640, 480, 'transport'),
                'description' => $faker->sentence,
                'location_id' => $faker->numberBetween(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
