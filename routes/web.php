<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\EvenementUserController;


//Route::get('/', [EvenementController::class, 'accueil'])->name('accueil');
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

// Authentification
Route::controller(AuthController::class)->group(function () {
    // inscription user simple
    Route::get('register-user', 'showRegistrationFormUser')->name('register');
    Route::post('register-user', 'registerUser')->name('register-traitement');
    // inscription association
    Route::get('register-association', 'showRegistrationFormAssociation')->name('register.association');
    Route::post('register-association', 'registerAssociation')->name('register-traitement.association');


    Route::get('login', 'showLoginForm')->name('login');
    Route::post('login', 'login');
    Route::get('logout', 'logout')->name('logout');
});

