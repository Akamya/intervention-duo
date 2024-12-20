<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Intervention;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Inertia\Inertia;

use function Laravel\Prompts\select;

class InterventionController extends Controller
{
    public function index($id)
    {
        // On vérifie que l'utilisateur courant est un administrateur
        // Gate::authorize('viewAny', interventions::class);

        $ticket =  Ticket::findOrFail($id);

        //with = si l'objet N'EXISTE PAS dans ce cas-la, utuilise with
        $interventions = Intervention::query()
            ->with(['user', 'ticket.client'])
            ->where('ticket_id', '=', $ticket->id)
            ->get();
        $statuts = Ticket::statuts();


        return Inertia::render('Interventions/Index', [
            'interventions' => $interventions,
            'ticket' => $ticket,
            'statuts' => $statuts,
        ]);
    }
    public function show($id)
    {

        //load = si l'objet existe deja, dans ce cas-la, findOrFail recupere l'objet
        $interventions =  Intervention::findOrFail($id)
            ->load(['user', 'ticket.client']);


        $img = Image::query()
            ->where('intervention_id', '=', $id)
            ->get();
        // dd($interventions);
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
        $validatedData = $request->validate([
            'title' => 'required|string|max:55',
            'comment' => 'required|string|max:255',
        ]);
        $request->validate([
            'img_path' => 'nullable|array',
            'img_path.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $intervention->ticket_id = $id;

        $intervention->user_id = Auth::user()->id;

        $intervention->title = $validatedData['title'];
        $intervention->comment = $validatedData['comment'];
        $intervention->save();
        if ($request->hasFile('img_path')) {

            for ($i = 0; $i < count($request->file('img_path')); $i++) {
                $image = Image::make();
                $image->img_path = $request->file('img_path')[$i]->store('images', 'public');
                $image->intervention_id = $intervention->id;
                $image->save();
            }
        }



        return redirect()->route("interventions.show", $intervention->id)->banner('Creation avec succès.');
    }

    public function statutUpdate(Request $request, Ticket $ticket)
    {
        // Validation des données
        $validatedData = $request->validate([
            'statut' => 'required|string|in:' . implode(',', Ticket::statuts()), //Cela vérifie que la valeur de categorie est bien parmi les catégories définies dans la méthode Ticket::categories(). Merci chatgpt
        ]);

        //sauvegarde
        $ticket->update($validatedData);

        // Redirection
        return redirect()->back()->banner('Mise à jour avec succès.');;
    }
    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // dd($intervention);
        $intervention = intervention::findOrFail($id)
            ->load(['images']);

        return Inertia::render('Interventions/Edit', [
            'intervention' => $intervention,
        ]);
    }

    public function update(Request $request, Intervention $intervention)
    {
        // $client = Client::findOrFail($id); // Récupère le client

        // dd($intervention);
        $validatedData = $request->validate([
            'title' => 'required|string|max:55',
            'comment' => 'required|string|max:255',
        ]);

        $intervention->update($validatedData);

        // Redirection ou réponse (selon vos besoins)
        return redirect()->route('interventions.index', $intervention->ticket_id);
    }


    public function rajout_images(Request $request, $intervention_id)
    {
        $request->validate([
            'img_path' => 'nullable|array',
            'img_path.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        // dd($request->hasFile('img_path'));

        if ($request->hasFile('img_path')) {

            for ($i = 0; $i < count($request->file('img_path')); $i++) {
                $image = Image::make();
                $image->img_path = $request->file('img_path')[$i]->store('images', 'public');
                $image->intervention_id = $intervention_id;
                $image->save();
            }
        }
        return redirect()->route("interventions.edit", $intervention_id)->banner('Creation avec succès.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $image = Image::findOrFail($id); // Récupère le client
        $image->delete();
        return redirect()->back();
    }
}
