<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\TicketController;

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
    Route::get('/tickets/create', [TicketController::class, "create"])->name('tickets.create');
    Route::get('/tickets/show', [TicketController::class, "create"])->name('tickets.create');
    Route::get('/users', [AdminUserController::class, "index"])->name('users.index');
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
