<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\EvenementUserController;

// Route de l'accueil
Route::get('/accueil', [EvenementController::class, 'accueil'])->name('accueil');
Route::post('/creation', [EvenementController::class, 'creation'])->name('creation');

// Routes pour les événements
Route::resource('evenements', EvenementController::class);

// Routes pour les utilisateurs d'événements
Route::resource('evenement_users', EvenementUserController::class);

