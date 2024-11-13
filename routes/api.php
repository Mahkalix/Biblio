<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControleurApi;

// Routes API
Route::post('connection', [ControleurApi::class, 'connection']);
Route::post('deconnection', [ControleurApi::class, 'deconnection']);

// Middleware personnalisé pour vérifier le jeton API
Route::middleware('api.token')->group(function () {
    Route::get('emprunts', [ControleurApi::class, 'emprunts']);
    Route::post('renouvellement', [ControleurApi::class, 'renouvellement']);
    Route::get('profil', [ControleurApi::class, 'profil']);
});
