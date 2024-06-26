<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\EvenementUserController;

// Route de l'accueil
Route::get('/', [EvenementController::class, 'accueil'])->name('accueil');

// Routes pour les événements
Route::resource('evenements', EvenementController::class);

// Routes pour les utilisateurs d'événements
Route::resource('evenement_users', EvenementUserController::class);

