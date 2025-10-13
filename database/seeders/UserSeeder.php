<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin user
        User::create([
            'username' => 'superadmin',
            'name' => 'Super Administrator',
            'email' => 'superadmin@bnn.go.id',
            'password' => Hash::make('superadmin123'),
            'role' => 'super-admin',
            'email_verified_at' => now(),
        ]);

        // Create Administrator user
        User::create([
            'username' => 'admin',
            'name' => 'Administrator',
            'email' => 'admin@bnn.go.id',
            'password' => Hash::make('admin123'),
            'role' => 'administrator',
            'email_verified_at' => now(),
        ]);

        // Create Operator user
        User::create([
            'username' => 'operator',
            'name' => 'Operator',
            'email' => 'operator@bnn.go.id',
            'password' => Hash::make('operator123'),
            'role' => 'operator',
            'email_verified_at' => now(),
        ]);
    }
}
