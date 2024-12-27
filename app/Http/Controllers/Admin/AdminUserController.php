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
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

use function Laravel\Prompts\select;

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
    public function destroy($keyd)
    {

        $user = User::findOrFail($keyd);
        Gate::authorize('delete', $user);

        if (Auth::id() !== $user->id) {
            $user->delete();
            return redirect()->back()->banner('Informations mises à jour avec succès.');
        }
    }

    public function reporting()
    {
        Gate::authorize('viewAny', User::class);
        // echo "Today is " . date("Y/m/d") . "<br>";
        // echo "Today is " . date("Y.m.d") . "<br>";
        // echo "Today is " . date("Y-m-d") . "<br>";
        // echo "Today is " . date("l");

        // $tickets = date("Y-m-d");
        // $tickets = DB::table('tickets')
        //     ->select('id', DB::raw('SUM(created_at) as total_ticket'))
        //     ->groupBy('id')
        //     // ->orderByRaw('created_at DESC')
        //     ->get();

        // $tickets = date("Y-m");
        // $ticket = Ticket::query()->select('created_at')->get();

        // $ticketsMois = DB::table('tickets')
        //     ->select('created_at')
        //     ->whereMonth('created_at', '12')
        //     ->get();

        $ticket = DB::table('tickets')
            ->select('created_at', DB::raw('count(*) as count'))
            ->groupBy(DB::raw('DATE(created_at)'))
            // ->orderby('created_at', 'DESC')
            ->get();

        // 1 savoir comien de fois le ticket a eter creer
        // 2 calculer le nombre de fois ticket par jour ET rassembler le tout a la date
        // un for sur l'année qui parcout datenow ANNEE suivi d'un for pour qui parcout les mois
        // 1) TRIER LES MOIS DE 30 et 31
        // et les jour qui suit ce mois ()

        // obtenir la date ex: 2024-12-18

        // foreach ($ticket as $key => $value) {
        //     $ticketDate[$key]  = substr($ticket[$key], 15, 10);
        //     $ticketsAnnee[$key]  = substr($ticket[$key], 15, 4);
        //     $ticketsMois[$key]  = substr($ticket[$key], 20, 2);
        //     $ticketsJour[$key]  = substr($ticket[$key], 23, 2);
        // }
        // dd($ticket[0]->created_at);

        foreach ($ticket as $key => $value) {

            $ticketsDate[$key]  =
                [
                    "created_at" =>  substr($ticket[$key]->created_at, 5, 5),
                    "count" => $ticket[$key]->count,

                ];
            $ticketsAnnee[$key]  =  [
                "created_at" =>  substr($ticket[$key]->created_at, 0, 10),
                "annee" => substr($ticket[$key]->created_at, 0, 4),
                "mois" => substr($ticket[$key]->created_at, 5, 2),
                "jour" => substr($ticket[$key]->created_at, 8, 3),
                "count" => $ticket[$key]->count,
                "couleur" => "test",
            ];
            $ticketsMois[$key]  =
                [
                    "created_at" =>  substr($ticket[$key]->created_at, 5, 2),
                    "count" => $ticket[$key]->count,

                ];
            $ticketsJour[$key]  =
                [
                    "created_at" =>  substr($ticket[$key]->created_at, 8, 3),
                    "count" => $ticket[$key]->count,
                ];
        }

        $mois31 =  ['01', '02', '03', '05', '07', '08', '10', '12'];
        $mois30 = ['04', '06', '09', '11'];
        $ticketsgraphique = [];

        // $ticketsJour = substr($ticketDate[1], 8,2); = jour
        // $ticketsMois = substr($ticketDate[1], 5, 2); = mois


        // 01,03,05,07,08,10,12  =>31
        // 04,06,09,11 => 30
        // 02 => 28
        $clients = Client::with('tickets.interventions.user')->orderBy('created_at', 'DESC')->get();

        return Inertia::render('User/Reporting', [
            // 'tickets' => $tickets,
            'clients' => $clients,
            'tickets' => $ticketsDate,
            'ticketsAnnee' => $ticketsAnnee,
            'ticketsMois' => $ticketsMois,
            'ticketsJour' => $ticketsJour,
            'ticketsgraphique' => $ticketsgraphique,
        ]);
    }
}
