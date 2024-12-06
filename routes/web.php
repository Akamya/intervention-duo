<?php


use App\Http\Controllers\Admin\AdminUserController;


use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
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
