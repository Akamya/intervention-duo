<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TicketController extends Controller
{
    public function create(Client $client)
    // Renvoie la page et les catégories (enum) du ticket
    {
        return Inertia::render('Tickets/Create', [
            'categories' => Ticket::categories(),
        ]);
    }

    public function store(Request $request)
{
    // Validation des données
    $validatedData = $request->validate([
        'title' => 'required|string|max:55',
        'categorie' => 'required|string|in:' . implode(',', Ticket::categories()), //Cela vérifie que la valeur de categorie est bien parmi les catégories définies dans la méthode Ticket::categories(). Merci chatgpt
        'commentaire' => 'nullable|string|max:2000',
        'client_id' => 'required|exists:clients,id', // Validation de la clé étrangère
    ]);

    $clientID = $validatedData['client_id'];

    // Création et sauvegarde
    $ticket = new Ticket();
    $ticket->title = $validatedData['title'];
    $ticket->categorie = $validatedData['categorie'];
    $ticket->commentaire = $validatedData['commentaire'];
    $ticket->client_id = $clientID;
    $ticket->save();

    // Redirection
    return redirect()->route('clients.show', $clientID);
}

}
