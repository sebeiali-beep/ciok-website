<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin CIOK',
            'email' => 'admin@ciok.tn',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    }
}