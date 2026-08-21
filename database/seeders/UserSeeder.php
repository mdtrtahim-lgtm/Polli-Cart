<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@pollicart.com',
            'mobile' => '01700000000',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'status' => true,
        ]);
        $superAdmin->roles()->attach(Role::where('name', 'Super Admin')->first());

        // Create Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin2@pollicart.com',
            'mobile' => '01700000001',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'status' => true,
        ]);
        $admin->roles()->attach(Role::where('name', 'Admin')->first());

        // Create Customer
        $customer = User::create([
            'name' => 'John Doe',
            'email' => 'customer@example.com',
            'mobile' => '01700000002',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'status' => true,
        ]);
        $customer->roles()->attach(Role::where('name', 'Customer')->first());

        // Create more customers
        for ($i = 3; $i <= 10; $i++) {
            $user = User::factory()->create([
                'mobile' => '0170000000' . $i,
            ]);
            $user->roles()->attach(Role::where('name', 'Customer')->first());
        }
    }
}
