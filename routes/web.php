<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\OffreEmploiController;

// Route par défaut redirige vers la liste des employés
Route::get('/', function () {
    // return view('welcome'); // Vue par défaut de Laravel (peut être supprimée)
    return redirect()->route('employes.index');
});

// Routes ressources pour les employés
Route::resource('employes', EmployeController::class);

// Routes ressources pour les offres d'emploi
Route::resource('offres', OffreEmploiController::class);

// Si vous utilisez l'authentification plus tard (non demandé ici)
// Route::middleware('auth')->group(function () {
//     Route::resource('employes', EmployeController::class);
//     Route::resource('offres', OffreEmploiController::class);
// });

// Si vous utilisez Laravel Breeze ou Jetstream, des routes d'authentification seront ajoutées ici
// require __DIR__.'/auth.php'; // Pour Breeze par exemple