<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
{
    // Reset cached roles and permissions
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    // Define roles
    $customer = Role::firstOrCreate(['name' => 'customer']);
    $agent = Role::firstOrCreate(['name' => 'agent']);
    $car_operator = Role::firstOrCreate(['name' => 'car_operator']);
    $driver = Role::firstOrCreate(['name' => 'driver']);
    $admin = Role::firstOrCreate(['name' =>'admin']);

    // Define permissions
    $permissions = [
        'book vehicle',
        'view booking history',
        'manage profile',
        'view all bookings',
        'manage vehicles',
        'assign vehicles to drivers',
        'manage fleet',
        'check vehicle availability',
        'update booking status',
        'view assigned bookings',
        'manage trips',
        'manage users',
        'manage roles',
        'manage permissions'
    ];

    foreach ($permissions as $permission) {
        Permission::firstOrCreate(['name' => $permission]);
    }

    // Assign permissions to roles
    $customer->syncPermissions(['book vehicle', 'view booking history', 'manage profile']);

    $agent->syncPermissions(['book vehicle', 'view all bookings', 'manage vehicles', 'assign vehicles to drivers']);

    $car_operator->syncPermissions(['manage fleet', 'check vehicle availability', 'update booking status', 'assign vehicles to drivers']);

    $driver->syncPermissions(['view assigned bookings', 'manage trips']);
    $admin->syncPermissions(['manage users',
        'manage roles',
        'manage permissions']);
}

}

