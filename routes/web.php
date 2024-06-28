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
Route::resource('permissions', PermissionController::class)->except('destroy', 'edit', 'update');
Route::delete('permissions/{id}', [PermissionController::class, 'destroy'])
        ->name('permissions.destroy')
        ->middleware('permission:delete permission');
Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])
        ->name('permissions.edit')
        ->middleware('permission:update permission');
Route::put('permissions/{permission}', [PermissionController::class, 'update'])
        ->name('permissions.update')
        ->middleware('permission:update permission');

Route::resource('roles', RoleController::class)->except('destroy', 'edit', 'update');
Route::delete('roles/{id}', [RoleController::class, 'destroy'])
        ->name('roles.destroy')
        ->middleware('permission:delete role');
Route::get('roles/{role}/edit', [RoleController::class, 'edit'])
        ->name('roles.edit')
        ->middleware('permission:update role');
Route::put('roles/{role}', [RoleController::class, 'update'])
        ->name('roles.update')
        ->middleware('permission:update role');

Route::resource('users', UserController::class);
Route::get('/dashboard', [UserController::class, 'dashboardAdmin'])->name('dashboard.admin');
Route::get('/profil-admin', [UserController::class, 'profilAdmin'])->name('profil.admin');
// Route::get('/detail-user', [UserController::class, 'detailUser'])->name('detail.user');
    Route::get('roles/{id}/give-permissions', [RoleController::class, 'addPermissionToRole'])
        ->name('role.permissions')
        ->middleware('permission:add permission');
    Route::put('roles/{id}/give-permissions', [RoleController::class, 'givePermissionToRole'])
        ->name('role.permissions.update')
        ->middleware('permission:add permission');

Route::resource('users', UserController::class);

Route::post('/user/{id}/validate', [UserController::class, 'validateAccount'])->name('user.validate');
Route::post('/user/{id}/invalidate', [UserController::class, 'invalidateAccount'])->name('user.invalidate');
Route::post('/user/{id}/activate', [UserController::class, 'activateAccount'])->name('user.activate');
Route::post('/user/{id}/deactivate', [UserController::class, 'deactivateAccount'])->name('user.deactivate');