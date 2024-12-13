<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TicketController extends Controller
{
    public function create()
    {
        return Inertia::render('Tickets/Create');
        // [
        //     'categories' => Ticket::cases(), // Renvoie toutes les valeurs de l'enum
        // ]);
    }
}
