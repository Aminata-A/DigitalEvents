<?php

use App\Models\EvenementUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\EvenementUserController;
use App\Models\Evenement;

// Routes publiques (non authentifiées)
Route::get('/', [EvenementController::class, 'accueil'])->name('accueil');
Route::get('/evenement', [EvenementController::class, 'evenement'])->name('evenement');


Route::middleware(['auth'])->group(function () {
    Route::get('/reservations', [EvenementUserController::class, 'index'])->name('reservations.index');
    Route::get('/creation', [EvenementController::class, 'create'])->name('creation');
    Route::post('/creation', [EvenementController::class, 'creation'])->name('creation.store');
});

Route::get('/evenement/{id}', [EvenementController::class, 'evenementDetail'])->name('evenement.detail')->where('id', '[0-9]+');
Route::post('/evenement/{id}/reserver', [EvenementController::class, 'reserver'])->name('evenement.reserver')->where('id', '[0-9]+');
Route::get('/mes-evenements', [EvenementController::class, 'mesEvenements'])->name('mes.evenements');


// Routes pour la création et gestion des événements')->where('id', '[0-9]')
Route::resource('evenements', EvenementController::class);
Route::put('/modifier/{id}', [EvenementController::class, 'modifier'])->name('modifier')->where('id', '[0-9]');
Route::delete('/supprimer/{id}', [EvenementController::class, 'supprimer'])->name('supprimer')->where('id', '[0-9]');
Route::get('/evenement/{id}', [EvenementController::class, 'show'])->name('evenements.show')->where('id', '[0-9]');
Route::put('/reservations/decline/{id}', [EvenementController::class, 'decline'])->name('reservations.decline');
Route::get('evenements/{id}/reservations', [EvenementUserController::class, 'showAllReservations'])->name('evenements.reservations');


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



Route::middleware(['auth'])->group(function () {

    Route::controller(RoleController::class)->group(function () {
        // Routes de ressource sans destroy, edit, update
        Route::resource('roles', RoleController::class)->except(['destroy', 'edit', 'update']);

        // Route pour la suppression des rôles avec middleware
        Route::delete('roles/{id}', 'destroy')->name('roles.destroy')->middleware('permission:delete role');

        // Routes pour l'édition et la mise à jour des rôles avec middleware
        Route::get('roles/{role}/edit', 'edit')->name('roles.edit')->middleware('permission:update role');
        Route::put('roles/{role}', 'update')->name('roles.update')->middleware('permission:update role');

        // Routes spécifiques pour les permissions associées aux rôles avec middleware
        Route::get('roles/{id}/give-permissions', 'addPermissionToRole')->name('role.permissions')->middleware('permission:add permission');
        Route::put('roles/{id}/give-permissions', 'givePermissionToRole')->name('role.permissions.update')->middleware('permission:add permission');
    });


    Route::controller(PermissionController::class)->group(function () {
        // Routes de ressource sans destroy, edit, update
        Route::resource('permissions', PermissionController::class)->except(['destroy', 'edit', 'update']);

        // Route pour la suppression des permissions avec middleware
        Route::delete('permissions/{id}', 'destroy')->name('permissions.destroy')->middleware('permission:delete permission');

        // Routes pour l'édition et la mise à jour des permissions avec middleware
        Route::get('permissions/{permission}/edit', 'edit')->name('permissions.edit')->middleware('permission:update permission');
        Route::put('permissions/{permission}', 'update')->name('permissions.update')->middleware('permission:update permission');
    });

    Route::controller(UserController::class)->group(function () {
        // Routes de ressource sans create et store
        Route::resource('users', UserController::class)->except(['create', 'store']);

        // Routes supplémentaires pour l'administration des utilisateurs
        Route::get('/dashboard', 'dashboardAdmin')->name('dashboard.admin');
        Route::get('/profil-admin', 'profilAdmin')->name('profil.admin');
        Route::post('/user/{id}/validate', 'validateAccount')->name('user.validate');
        Route::post('/user/{id}/invalidate', 'invalidateAccount')->name('user.invalidate');
        Route::post('/user/{id}/activate', 'activateAccount')->name('user.activate');
        Route::post('/user/{id}/deactivate', 'deactivateAccount')->name('user.deactivate');


    });
});

