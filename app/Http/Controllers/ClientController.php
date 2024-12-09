<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('tickets')->orderBy('created_at', 'DESC')->get();

        return Inertia::render('Clients/Index', [
            'clients' => $clients,
        ]);
    }

    public function create()
    {
        return Inertia::render('Clients/Create');
    }

    public function store(Request $request)
{
    // Validation des données
    $validatedData = $request->validate([
        'nom' => 'required|string|max:2000',
        'prenom' => 'required|string|max:2000',
        'email' => 'required|string|email|unique:clients,email|max:2000',
        'telephone' => 'required|string|max:2000',
    ]);

    // Création et sauvegarde du client
    $client = new Client();
    $client->nom = $validatedData['nom'];
    $client->prenom = $validatedData['prenom'];
    $client->email = $validatedData['email'];
    $client->telephone = $validatedData['telephone'];
    $client->save();

    // Redirection
    return redirect()->route('clients.index');
}

public function edit(Client $client)
    {
        return Inertia::render('Clients/Edit', [
            'client' => $client,
        ]);
    }


public function update(Request $request, Client $client)
{
    // Met à jour les autres champs
    $client->nom = $request->validated()['nom'];
    $client->prenom = $request->validated()['prenom'];
    $client->email = $request->validated()['email'];
    $client->telephone = $request->validated()['telephone'];
    $client->save(); // Sauvegarde les modifications

    return redirect()->route('clients.index');
}

public function destroy($id)
    {
        $client = Client::findOrFail($id); // Récupère le client
        $client->delete();
        return redirect()->back();
    }

}
