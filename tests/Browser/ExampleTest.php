<?php

use App\Models\Client;

use App\Models\User;
use Laravel\Dusk\Browser;

use Tests\DuskTestCase;


test('visit site', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/')
            ->screenshot('visit') // Sauvegarde la capture d'écran dans le dossier tests/Browser/screenshots

            ->assertSee('Email');
    });
});

test('connexion', function () {
    $user = User::factory()->create();
    $this->browse(function (Browser $browser) use ($user) {

        $browser->loginAs($user)
            ->visit('/')
            ->screenshot('Dash') // Sauvegarde la capture d'écran dans le dossier tests/Browser/screenshots
            ->assertSee('Email');
    });
});


test('click modal', function () {
    $this->browse(function (Browser $browser) {
        // Crée un utilisateur pour le test
        $user = User::factory()->create();

        // Crée un client avec les données nécessaires
        // $client = Client::factory()->create([
        //     'nom' => 'Test Title',
        //     'prenom' => 'Bug Report',
        //     'email' => 'hdjd@kjfkf.jdd',
        //     'telephone' => 'hdjd@kjfkf.jdd',
        // ]);

        // Simulation de navigation et d'interaction
        $browser->loginAs($user) // Connexion avec l'utilisateur
            ->visit('/') // Page principale
            ->click('#create')
            // Clic sur le bouton de soumission
            ->waitForLocation('/clients/create')  // Attend 1 seconde
            ->type('#nom', "bfbfbfbf") // Remplit le champ "title"
            ->type('#prenom', "bvbvbvvbbv") // Remplit le champ "categorie"
            ->type('#email', "dingo@jjvf.jbbfdj") // Remplit le champ "commentaire"
            ->type('#telephone', "5455454") // Remplit le champ "commentaire"
            ->click('#submit-button') // Clic sur le bouton de soumission
            ->waitForLocation('/') // Attendre que la redirection vers la page des clients soit complète


            ->click('#open-modal-button') // Clic sur le bouton qui ouvre le modal
            ->pause(1000) // Pause pour s'assurer que le modal est complètement chargé
            ->screenshot('modal-opened') // Capture d'écran du modal
            ->assertSee('Clients') // Vérifie que le contenu attendu est visible
            ->screenshot('client-created'); // Capture d'écran après création
    });
});

            // ->click('#open-modal-button') // Clic sur le bouton qui ouvre le modal
            // ->pause(1000) // Pause pour s'assurer que le modal est complètement chargé
            // ->screenshot('modal-opened') // Capture d'écran du modal
            // ->assertSee('Clients') // Vérifie que le contenu attendu est visible
            // ->screenshot('client-created'); // Capture d'écran après création

// test('non-admin cannot access technician page', function () {
//     $this->browse(function (Browser $browser) {
//         // Crée un utilisateur standard (non admin)
//         $user = User::factory()->create([
//             'is_admin' => 0,
//         ]);

//         // Connexion et tentative d'accès à la page "technicien"
//         $browser->loginAs($user) // Connexion avec l'utilisateur standard
//             ->visit('/admin/technicien') // Essaie d'accéder à la page "technicien"
//             ->pause(1000) // Pause pour s'assurer que la redirection ou le message se charge
//             ->assertPathIsNot('/admin/technicien') // Vérifie que l'utilisateur n'est pas resté sur la page
//             ->assertSee('Access denied'); // Vérifie qu'un message d'erreur s'affiche
//     });
// });
