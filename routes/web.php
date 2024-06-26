<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\EvenementUserController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [EvenementController::class, 'accueil'])->name('accueil');
Route::resource('evenements', EvenementController::class);
Route::resource('evenement_users', EvenementUserController::class);


// Authentification
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'showRegistrationForm')->name('register');
    Route::post('register', 'register');
    Route::get('login', 'showLoginForm')->name('login');
    Route::post('login', 'login');
    Route::post('logout', 'logout')->name('logout');
});
