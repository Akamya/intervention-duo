<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Ticket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'nom' => 'Test User',
            'email' => 'test@example.com',
            "is_admin" => true,
        ]);
        $this->call([
            // RolesTableSeeder::class,
            UserSeeder::class,
            ClientSeeder::class,
            TicketSeeder::class,
            InterventionSeeder::class,
            ImageSeeder::class,
        ]);
    }
}
