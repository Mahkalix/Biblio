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
        Route::prefix('ouvrages/{ouvrage}/exemplaires')->name('ouvrages.exemplaires.')->group(function () {
            Route::get('/', [ExemplaireController::class, 'index'])->name('index');
            Route::get('/create', [ExemplaireController::class, 'create'])->name('create');
            Route::post('/', [ExemplaireController::class, 'store'])->name('store');
            Route::patch('/{exemplaire}/toggle-visibility', [ExemplaireController::class, 'toggleVisibility'])->name('toggleVisibility');
        });

        Route::post('/usager', [ControleurRecherche::class, 'rechercherUsager'])->name('usager.rechercher');
        Route::get('/recherche', [ControleurRecherche::class, 'index'])->name('recherche.index');
        Route::post('/ouvrage', [ControleurRecherche::class, 'rechercherOuvrage'])->name('bibliotheque.rechercher');
    });
});


require __DIR__ . '/auth.php';
