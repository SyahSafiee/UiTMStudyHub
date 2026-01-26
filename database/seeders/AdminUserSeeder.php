<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@uitm.edu.my', // Admin email
            'password' => Hash::make('UiTMHub08!'), // Admin password
            'role' => 'admin', // Set role as admin
        ]);
    }
}
