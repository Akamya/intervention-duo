<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Intervention;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Inertia\Inertia;

class InterventionController extends Controller
{
    public function index($id)
    {
        // On vérifie que l'utilisateur courant est un administrateur
        // Gate::authorize('viewAny', interventions::class);

        $ticket_id =  Ticket::findOrFail($id);

        $interventions = Intervention::query()
            ->where('ticket_id', '=', $ticket_id->id)
            ->get();
        // dd($interventions);


        return Inertia::render('Interventions/Index', [
            'interventions' => $interventions,
            'id' => $id,
        ]);
    }
    public function show($id)
    {
        $interventions =  Intervention::findOrFail($id);
        $img = Image::query()
            ->where('intervention_id', '=', $id)
            ->get();

        return Inertia::render('Interventions/Show', [
            'interventions' => $interventions,
            'images' => $img,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {

        return Inertia::render('Interventions/Create', [
            'id' => $id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {

        //passage de la route, l'id du ticket
        $intervention = Intervention::make();
        $image = Image::make();

        // RECUP DE TICKET_ID

        // grace au ticket_id , recup le client id
        // RECUP DE USER_ID

        // 'title' => 'required|string|max:255',
        // 'price' => 'required|max:255',
        // 'address' => 'required|max:25',
        // 'number_of_rooms' => 'required|max:25',
        // 'size' => 'required|max:25',
        // 'description' => 'required|max:25',
        // 'img_path' => 'required|max:2000',
        $validatedData = $request->validate([
            'title' => 'required|string|max:55',
            'comment' => 'required|string|max:255',
            'img_path' => 'required|image|max:2048',

        ]);
        $intervention->ticket_id = $id;
        $intervention->client_id = Ticket::query()
            ->select("client_id")
            ->where('id', '=', $id)
            ->first();
        $intervention->title = $request->validated()['title'];
        $intervention->comment = $request->validated()['comment'];
        $image->img_path = $request->file('img_path')->store('images', 'public');
        $image->intervention_id = $id;


        // Si il y a une image, on la sauvegarde
        // if ($request->hasFile('img')) {
        //     $path = $request->file('img')->store('users', 'public');
        //     $intervention->img_path = $path;
        // }

        $intervention->save();
        $image->save();
        return back()->banner('Creation avec succès.');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(interventions $interventions)
    // {
    //     // On vérifie que l'utilisateur courant est un administrateur
    //     Gate::authorize('update', $interventions);

    //     // On récupère tous les rôles disponibles
    //     // On utilise la méthode pluck() pour récupérer uniquement le nom des rôles dans un tableau
    //     $roles = \App\Models\Role::pluck('name');

    //     // On passe l'utilisateur et les rôles à la vue `admin.interventions.edit`
    //     return view('admin.interventions.edit', [
    //         'interventions' => $interventions,
    //         'roles' => $roles,
    //     ]);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Intervention $interventions) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
