<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControleurUsagers;
use App\Http\Controllers\OuvrageController;
use App\Http\Controllers\ExemplaireController;
use App\Http\Controllers\ControleurRecherche;



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


        Route::post('/usagers/rechercher', [ControleurRecherche::class, 'rechercherUsager'])->name('usager.rechercher');
        Route::post('/biblioteque/rechercher', [ControleurRecherche::class, 'rechercher'])->name('bibliotheque.rechercher');
    });
});


require __DIR__ . '/auth.php';
