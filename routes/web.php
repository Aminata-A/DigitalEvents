<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\EvenementUserController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/', [EvenementController::class, 'accueil'])->name('accueil');
Route::resource('evenements', EvenementController::class);
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


// Permissions
Route::resource('permissions', PermissionController::class);
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::get('/dashboard', [UserController::class, 'dashboardAdmin'])->name('dashboard.admin');
Route::get('/profil-admin', [UserController::class, 'profilAdmin'])->name('profil.admin');
