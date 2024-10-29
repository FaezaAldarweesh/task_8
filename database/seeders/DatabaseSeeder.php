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
        $this->call([
            AdminSeeder::class,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Raghad Shammout',
            'email' => 'raghadshammout3010@gmail.com',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'faeza aldarweesh',
            'email' => 'faeza.aladarweesh@gmail.com',
        ]);

        \App\Models\User::factory(2)->create();
    }
}
