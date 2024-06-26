<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\EvenementUserController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [EvenementController::class, 'accueil'])->name('accueil');
Route::resource('evenements', EvenementController::class);
Route::resource('evenement_users', EvenementUserController::class);
