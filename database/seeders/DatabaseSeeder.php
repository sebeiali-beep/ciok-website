<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            PostSeeder::class,
        ]);


        $this->call([
    UserSeeder::class,
    CategorySeeder::class,
    ProductSeeder::class,
    PostSeeder::class,
    TenderSeeder::class,   // ← AJOUTER CETTE LIGNE
]);
    }
    
}