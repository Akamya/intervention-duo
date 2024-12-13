<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TicketController extends Controller
{
    public function create()
    {
        return Inertia::render('Tickets/Create');
    }
}
