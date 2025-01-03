<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\FacebookAuthController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//Google OAuth
Route::get("/auth/google", [GoogleAuthController::class, "redirect"])
    ->name("auth.google");
Route::get("/auth/google/callback", [GoogleAuthController::class, "callback"])
    ->name("auth.google.callback");

//Facebook OAuth
Route::get("/auth/facebook", [FacebookAuthController::class, "redirect"])
    ->name("auth.facebook");
Route::get("/auth/facebook/callback", [FacebookAuthController::class, "callback"])
    ->name("auth.facebook.callback");

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
