<?php

namespace App\Http\Controllers;

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


        $interventions = Intervention::query()
            ->where('ticket_id', '=', $id)
            ->get();
        // dd($interventions);


        return Inertia::render('Interventions/Index', [
            'interventions' => $interventions,
        ]);
    }
    public function show($id)
    {
        $interventions =  Intervention::findOrFail($id);

        return Inertia::render('Interventions/Show', [
            'interventions' => $interventions,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

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
