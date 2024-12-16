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

        $ticket_id =  Ticket::findOrFail($id);

        //with = si l'objet N'EXISTE PAS dans ce cas-la, utuilise with
        $interventions = Intervention::query()
            ->with(['user', 'ticket.intervention'])
            ->where('ticket_id', '=', $ticket_id->id)
            ->get();


        return Inertia::render('Interventions/Index', [
            'interventions' => $interventions,
            'id' => $id,
        ]);
    }
    public function show($id)
    {

        //load = si l'objet existe deja, dans ce cas-la, findOrFail recupere l'objet
        $interventions =  Intervention::findOrFail($id)
            ->load(['user', 'ticket.intervention']);


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

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // dd($intervention);
        $intervention = intervention::findOrFail($id);
        return Inertia::render('Interventions/Edit', [
            'intervention' => $intervention,
        ]);
    }

    public function update(Request $request, intervention $intervention)
    {
        // dd($intervention);
        $validatedData = $request->validate([
            'nom' => 'required|string|max:2000',
            'prenom' => 'required|string|max:2000',
            'email' => [
                'required',
                'string',
                'email',
                'max:2000',
                Rule::unique('interventions')->ignore($intervention->id),
            ],
            'telephone' => 'required|string|max:2000',
        ]);

        $intervention->update($validatedData);

        return redirect()->route('interventions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
