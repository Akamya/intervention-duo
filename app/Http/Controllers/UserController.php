<?php

namespace App\Http\Controllers;

use App\Http\Request\userCreate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {

        // Logique pour créer un utilisateur
        // user::create($request->all());

        // Redirection vers la page d'index des utilisateurs
        return redirect()->route('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(UserCreate $request)
    // {
    //     // On crée un nouvel user
    //     $user = user::make();
    //     // On ajoute les propriétés du user
    //     // 'title' => 'required|string|max:255',
    //     // 'price' => 'required|max:255',
    //     // 'address' => 'required|max:25',
    //     // 'number_of_rooms' => 'required|max:25',
    //     // 'size' => 'required|max:25',
    //     // 'description' => 'required|max:25',
    //     // 'img_path' => 'required|max:25',
    //     $user->title = $request->validated()['title'];
    //     $user->price = $request->validated()['price'];
    //     $user->address = $request->validated()['address'];
    //     $user->number_of_rooms = $request->validated()['number_of_rooms'];
    //     $user->size = $request->validated()['size'];
    //     $user->description = $request->validated()['description'];
    //     $user->img_path = $request->file('img_path')->store('users', 'public');
    //     $user->user_id = Auth::id();


    //     // Si il y a une image, on la sauvegarde
    //     // if ($request->hasFile('img')) {
    //     //     $path = $request->file('img')->store('users', 'public');
    //     //     $user->img_path = $path;
    //     // }
    //     // On sauvegarde le user en base de données
    //     $user->save();

    //     return back()->banner('Creation avec succès.');
    // }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Gate::authorize('update', $user);
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UserCreate $request, user $user)
    // {
    //     // Gate::authorize('update', $user);

    //     $user->body = $request->validated()['body'];

    //     // Si il y a une image, on la sauvegarde
    //     if ($request->hasFile('img')) {
    //         $path = $request->file('img')->store('users', 'public');
    //         $user->img_path = $path;
    //     }

    //     // On sauvegarde les modifications en base de données
    //     $user->save();
    //     return redirect()->route('front.users.index');
    //     // return redirect()->back();
    // }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Gate::authorize('delete', $user);
        // $user->delete();

        // return redirect()->back();
    }
}
