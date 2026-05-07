<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BusController; // Pindahin ke atas sini
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route untuk Profile (Bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route sakti untuk CRUD Bus kamu
// Ledi bakal bisa akses: bus.index, bus.create, bus.edit, dll.
Route::resource('bus', BusController::class);

require __DIR__.'/auth.php';