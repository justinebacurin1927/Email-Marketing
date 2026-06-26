<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        User::factory()->create([
            'name' => 'Demo User',
            'email' => 'demo@sendflow.test',
            'password' => bcrypt('password'),
        ]);

        $this->call(SampleDataSeeder::class);
    }
}
