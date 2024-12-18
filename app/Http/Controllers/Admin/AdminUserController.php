<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Intervention;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminUserController extends Controller
{
    public function index()
    {
        // On vérifie que l'utilisateur courant est un administrateur
        Gate::authorize('viewAny', User::class);

        // On récupère tous les utilisateurs avec pagination de 10 par page
        $users = User::query()
            ->select("id", "nom", "prenom", "email", "is_admin")
            ->get();

        // On passe les utilisateurs à la vue `admin.users.index`
        return Inertia::render('User/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('User/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('store', User::class);

        // Validation des données
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|max:125',
        ]);

        // Création et sauvegarde du client
        $client = new User();
        $client->nom = $validatedData['nom'];
        $client->prenom = $validatedData['prenom'];
        $client->email = $validatedData['email'];
        $client->password = $validatedData['password'];
        $client->save();

        // Redirection
        return redirect()->back()->banner('Créations avec succès.');
    }

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
    // public function edit(User $user)
    // {
    //     // On vérifie que l'utilisateur courant est un administrateur
    //     Gate::authorize('update', $user);

    //     // On récupère tous les rôles disponibles
    //     // On utilise la méthode pluck() pour récupérer uniquement le nom des rôles dans un tableau
    //     $roles = \App\Models\Role::pluck('name');

    //     // On passe l'utilisateur et les rôles à la vue `admin.users.edit`
    //     return view('admin.users.edit', [
    //         'user' => $user,
    //         'roles' => $roles,
    //     ]);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user)
    {
        Gate::authorize('update', $user);

        if (Auth::id() !== $user->id) {
            ($user->is_admin) ? $user->is_admin = false : $user->is_admin = true;
            $user->save();
            return redirect()->back()->banner('Informations mises à jour avec succès.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $user = User::findOrFail($id);
        Gate::authorize('delete', $user);

        if (Auth::id() !== $user->id) {
            $user->delete();
            return redirect()->back()->banner('Informations mises à jour avec succès.');
        }
    }

    public function reporting()
    {
        Gate::authorize('viewAny', User::class);

        // $tickets = Ticket::with('interventions.user')->orderBy('created_at', 'DESC')->get();
        $clients = Client::with('tickets.interventions.user')->orderBy('created_at', 'DESC')->get();

        return Inertia::render('User/Reporting', [
            // 'tickets' => $tickets,
            'clients' => $clients,
        ]);
    }
}
