<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('tickets')->get();

        return Inertia::render('Clients/Index', [
            'clients' => $clients,
        ]);
    }
}
