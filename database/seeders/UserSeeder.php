<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin Skyfood',
                'email' => 'admin@skyfood.com',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => bcrypt('password123'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => bcrypt('password123'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bob Johnson',
                'email' => 'bob@example.com',
                'password' => bcrypt('password123'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
