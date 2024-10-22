<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControleurUsagers;
use App\Http\Controllers\OuvrageController;
use App\Http\Controllers\ExemplaireController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('usagers', ControleurUsagers::class);
    Route::resource('ouvrages', OuvrageController::class);
    Route::resource('ouvrages.exemplaires', ExemplaireController::class);
    Route::get('ouvrages/{id}/exemplaires', [ExemplaireController::class, 'index'])->name('ouvrages.exemplaires');
    Route::get('ouvrages/{id}/exemplaires/create', [ExemplaireController::class, 'create'])->name('exemplaires.create');
    Route::post('exemplaires', [ExemplaireController::class, 'store'])->name('exemplaires.store');
    Route::get('exemplaires/{exemplaire}/edit', [ExemplaireController::class, 'edit'])->name('exemplaires.edit');
    Route::put('exemplaires/{exemplaire}', [ExemplaireController::class, 'update'])->name('exemplaires.update');
    Route::delete('exemplaires/{exemplaire}', [ExemplaireController::class, 'destroy'])->name('exemplaires.destroy');
});

require __DIR__ . '/auth.php';
