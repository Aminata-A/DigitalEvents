<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\EvenementUserController;

// Routes publiques (non authentifiées)
Route::get('/', [EvenementController::class, 'accueil'])->name('accueil');
Route::get('/evenement', [EvenementController::class, 'evenement'])->name('evenement');
Route::get('/evenement-detail', [EvenementController::class, 'evenementDetail'])->name('evenement-detail');

// Routes pour la création et gestion des événements
Route::resource('evenements', EvenementController::class)->except(['create', 'store', 'edit', 'update']);
Route::get('/creation', [EvenementController::class, 'create'])->name('creation');
Route::post('/creation', [EvenementController::class, 'creation'])->name('creation.store');
Route::put('/modifier/{id}', [EvenementController::class, 'modifier'])->name('modifier')->where('id', '[0-9]');
Route::delete('/supprimer/{id}', [EvenementController::class, 'supprimer'])->name('supprimer')->where('id', '[0-9]');
Route::get('/evenements/{id}', [EvenementController::class, 'show'])->name('evenements.show')->where('id', '[0-9]');
Route::get('/mes-evenements', [EvenementController::class, 'mesEvenements'])->name('mes-evenements');

// Routes pour les utilisateurs d'événements
Route::resource('evenement_users', EvenementUserController::class)->only(['index', 'show', 'store', 'destroy']);

// Routes d'authentification et gestion des utilisateurs
Route::group(['prefix' => 'auth'], function () {
    Route::get('register-user', [AuthController::class, 'showRegistrationFormUser'])->name('register');
    Route::post('register-user', [AuthController::class, 'registerUser'])->name('register-traitement');

    Route::get('register-association', [AuthController::class, 'showRegistrationFormAssociation'])->name('register.association');
    Route::post('register-association', [AuthController::class, 'registerAssociation'])->name('register-traitement.association');

    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

// Routes spécifiques pour les utilisateurs authentifiés
Route::middleware(['auth'])->group(function () {
    // Routes pour la gestion des rôles
    Route::resource('roles', RoleController::class)->except(['destroy', 'edit', 'update']);
    Route::delete('roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('permission:delete role');
    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('permission:update role');
    Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:update role');
    Route::get('roles/{id}/give-permissions', [RoleController::class, 'addPermissionToRole'])->name('role.permissions')->middleware('permission:add permission');
    Route::put('roles/{id}/give-permissions', [RoleController::class, 'givePermissionToRole'])->name('role.permissions.update')->middleware('permission:add permission');

    // Routes pour la gestion des permissions
    Route::resource('permissions', PermissionController::class)->except(['destroy', 'edit', 'update']);
    Route::delete('permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy')->middleware('permission:delete permission');
    Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware('permission:update permission');
    Route::put('permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update')->middleware('permission:update permission');

    // Routes pour l'administration des utilisateurs
    Route::resource('users', UserController::class)->except(['create', 'store']);
    Route::get('/dashboard', [UserController::class, 'dashboardAdmin'])->name('dashboard.admin');
    Route::get('/profil-admin', [UserController::class, 'profilAdmin'])->name('profil.admin');
    Route::post('/user/{id}/validate', [UserController::class, 'validateAccount'])->name('user.validate');
    Route::post('/user/{id}/invalidate', [UserController::class, 'invalidateAccount'])->name('user.invalidate');
    Route::post('/user/{id}/activate', [UserController::class, 'activateAccount'])->name('user.activate');
    Route::post('/user/{id}/deactivate', [UserController::class, 'deactivateAccount'])->name('user.deactivate');

    // Route pour les réservations
    Route::get('/reservations', [EvenementUserController::class, 'index'])->name('reservations.index');
});

// Routes supplémentaires
Route::get('/evenement/{id}', [EvenementController::class, 'evenementDetail'])->name('evenement.detail')->where('id', '[0-9]');
Route::post('/evenement/{id}/reserver', [EvenementController::class, 'reserver'])->name('evenement.reserver')->where('id', '[0-9]');
