<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\LocationSeeder;
use Database\Seeders\BookingsTableSeeder;
use Database\Seeders\VehiclesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
            LocationSeeder::class,
            VehiclesTableSeeder::class,

        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'venkateshmusku6@gmail.com',
            'password' => bcrypt('password')
        ]);

        $admin->assignRole('admin');
    }
}
