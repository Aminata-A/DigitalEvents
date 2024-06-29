<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\EvenementUserController;

// Route de l'accueil
// Route::get('/accueil', [EvenementController::class, 'accueil'])->name('accueil');
Route::get('/evenement', [EvenementController::class, 'evenement'])->name('evenement');
Route::get('/creation', [EvenementController::class, 'create'])->name('creation');
Route::post('/creation', [EvenementController::class, 'creation'])->name('creation.store');
Route::put('/modifier/{id}', [EvenementController::class, 'modifier'])->name('modifier');
Route::delete('/supprimer/{id}', [EvenementController::class, 'supprimer'])->name('supprimer');

// Routes pour les événements
Route::resource('evenements', EvenementController::class);

// Routes pour les utilisateurs d'événements
Route::resource('evenement_users', EvenementUserController::class);

