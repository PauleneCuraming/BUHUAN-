<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
        'first_name' => 'Admin',
        'last_name' => 'Barangay',
        'name' => 'Admin Barangay',
        'email' => 'admin@buhuan.com',
        'password' => bcrypt('password'),
        'role' => 'admin',
        'is_approved' => true,
        ]);
    }
}
