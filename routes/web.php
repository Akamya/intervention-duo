<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Models\User;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Admin\AdminUserController;




Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canRegister' => Route::has('register'),
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/clients/index', [ClientController::class, 'index'])->name('clients.index');
});




Route::get('/users', [AdminUserController::class, "index"])->name('users.index');

// Route::post('/users/updated', [UserAdminController::class, "store"])->name('users.store');

// PARTIE ADMIN
Route::middleware(['auth'])->prefix('admin')->group(function () {

    // Route::get('/users', function () {
    //     $users = User::all();
    //     return Inertia::render('User/index', ['users' => $users]);
    // })->name('users.index');

});
