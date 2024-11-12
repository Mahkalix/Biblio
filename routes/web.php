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

    // Other routes...

    Route::middleware('auth')->group(function () {
        // Other routes...

        // Nested exemplaires under ouvrages
        Route::get('ouvrages/{ouvrage}/exemplaires', [ExemplaireController::class, 'index'])->name('ouvrages.exemplaires.index');
        Route::get('ouvrages/{ouvrage}/exemplaires/create', [ExemplaireController::class, 'create'])->name('ouvrages.exemplaires.create');
        Route::post('ouvrages/{ouvrage}/exemplaires', [ExemplaireController::class, 'store'])->name('ouvrages.exemplaires.store');
        Route::patch('ouvrages/{ouvrage}/exemplaires/{exemplaire}/toggle-visibility', [ExemplaireController::class, 'toggleVisibility'])->name('ouvrages.exemplaires.toggleVisibility');


        Route::get('ouvrages/{ouvrage}/exemplaires/{exemplaire}/edit', [ExemplaireController::class, 'edit'])->name('ouvrages.exemplaires.edit');
        Route::put('ouvrages/{ouvrage}/exemplaires/{exemplaire}', [ExemplaireController::class, 'update'])->name('ouvrages.exemplaires.update');
        Route::delete('ouvrages/{ouvrage}/exemplaires/{exemplaire}', [ExemplaireController::class, 'destroy'])->name('ouvrages.exemplaires.destroy');
    });
});


require __DIR__ . '/auth.php';
