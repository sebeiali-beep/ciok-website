<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Vérifier si l'admin existe déjà
        if (User::where('email', 'admin@ciok.tn')->exists()) {
            $this->command->info('UserSeeder: admin@ciok.tn existe déjà, ignoré.');
            return;
        }

        User::create([
            'name' => 'Admin CIOK',
            'email' => 'admin@ciok.tn',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_admin' => true,
            'role' => 'super_admin',
        ]);

        $this->command->info('UserSeeder: admin@ciok.tn créé avec succès.');
    }
}