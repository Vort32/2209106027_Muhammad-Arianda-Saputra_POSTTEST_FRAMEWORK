<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // contoh seeder bawaan
        // \App\Models\User::factory(10)->create();

        // panggil MaterialSeeder
        $this->call([
            MaterialSeeder::class,
            ResearchDataSeeder::class,
        ]);
    }
}
