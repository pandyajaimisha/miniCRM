<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Adriit Solutions',
            'email' => 'admin@adriitsolutions.com',
            'password' => bcrypt('Admin@1234')
        ]);
    }
}
