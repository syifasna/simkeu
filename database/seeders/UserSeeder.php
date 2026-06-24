<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@assulthon.com',
            'password' => Hash::make('123456'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Staff Keuangan',
            'email' => 'staff@assulthon.com',
            'password' => Hash::make('123456'),
            'role' => 'staff'
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@assulthon.com',
            'password' => Hash::make('123456'),
            'role' => 'user'
        ]);
    }
}
