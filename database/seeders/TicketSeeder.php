<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Ticket::factory()->create([
            'client_id' => '1',
            'statut' => 'ToDo',
            "categorie" => NULL,
            "commentaire" => 'fggfgg',
            "title" => 'fggfgf',
            "created_at" => '2023-11-18 15:54:41',
            "updated_at" => '2023-11-18 15:54:41',

        ]);
        Ticket::factory()->create([
            'client_id' => '1',
            'statut' => 'ToDo',
            "categorie" => NULL,
            "commentaire" => 'fggfgg',
            "title" => 'fggfgf',
            "created_at" => '2023-11-15 15:54:41',
            "updated_at" => '2023-11-15 15:54:41',

        ]);
        Ticket::factory()->create([
            'client_id' => '1',
            'statut' => 'ToDo',
            "categorie" => NULL,
            "commentaire" => 'fggfgg',
            "title" => 'fggfgf',
            "created_at" => '2025-01-16 15:54:41',
            "updated_at" => '2025-01-16 15:54:41',

        ]);
        Ticket::factory()->create([
            'client_id' => '1',
            'statut' => 'ToDo',
            "categorie" => NULL,
            "commentaire" => 'fggfgg',
            "title" => 'fggfgf',
            "created_at" => '2025-01-15 15:54:41',
            "updated_at" => '2025-01-15 15:54:41',

        ]);
        Ticket::factory()->create([
            'client_id' => '1',
            'statut' => 'ToDo',
            "categorie" => NULL,
            "commentaire" => 'fggfgg',
            "title" => 'fggfgf',
            "created_at" => '2024-12-15 15:54:41',
            "updated_at" => '2024-12-15 15:54:41',

        ]);
        Ticket::factory()
            ->count(10)
            ->create();
    }
}
