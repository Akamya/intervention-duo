<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\InterventionController;
use App\Models\Intervention;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/create', [ClientController::class, "create"])->name('clients.create');
    Route::post('/clients/store', [ClientController::class, "store"])->name('clients.store');
    Route::get('/clients/edit/{id}', [ClientController::class, "edit"])->name('clients.edit');
    Route::put('/clients/update/{client}', [ClientController::class, "update"])->name('clients.update');
    Route::delete('/clients/destroy/{id}', [ClientController::class, "destroy"])->name('clients.destroy');

    Route::get('/clients/show/{id}', [ClientController::class, "show"])->name('clients.show');
    Route::get('/tickets/create/{client}', [TicketController::class, "create"])->name('tickets.create');
    Route::post('/tickets/store', [TicketController::class, "store"])->name('tickets.store');
    Route::get('/users', [AdminUserController::class, "index"])->name('users.index');

    // Route::get('/interventions/index/{ticketid}', [InterventionController::class, "index"])->name('interventions.index');
    Route::get('/interventions/index/{id}', [InterventionController::class, "index"])->name('interventions.index');
    Route::get('/interventions/show/{id}', [InterventionController::class, "show"])->name('interventions.show');
    Route::get('/interventions/edit/{id}', [InterventionController::class, "edit"])->name('interventions.edit');
    Route::put('/interventions/update/{intervention}', [InterventionController::class, "update"])->name('interventions.update');

    Route::post('/interventions/rajoutimage/{id}', [InterventionController::class, "rajout_images"])->name('interventions.rajout_images');
    Route::get('/interventions/create/{id}', [InterventionController::class, "create"])->name('interventions.create');
    Route::post('/interventions/store/{id}', [InterventionController::class, "store"])->name('interventions.store');
    Route::delete('/interventions/delete/{id}', [InterventionController::class, "destroy"])->name('interventions.delete.image');
    Route::put('/interventions/index/{ticket}', [InterventionController::class, "statutUpdate"])->name('interventions.statuts');
});

// Route::post('/users/updated', [UserAdminController::class, "store"])->name('users.store');

// PARTIE ADMIN
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/users', [AdminUserController::class, "index"])->name('users.index');
    Route::put('/users/{user}', [AdminUserController::class, "update"])->name('users.update');
    Route::get('/users/create', [AdminUserController::class, "create"])->name('users.create');
    Route::post('/users/store', [AdminUserController::class, "store"])->name('users.store');
    Route::delete('/users/destroy/{id}', [AdminUserController::class, "destroy"])->name('users.destroy');
});
