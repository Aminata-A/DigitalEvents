<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;

class PermissionController extends Controller
{
    /**
     * Affiche une liste paginée des permissions.
     */
    public function index()
    {
        // Récupère les permissions avec une pagination de 6 éléments par page
        $permissions = Permission::paginate(6);

        // Retourne la vue 'permissions.index' avec les permissions
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Stocke une nouvelle permission.
     */
    public function store(StorePermissionRequest $request)
    {
        // Crée une nouvelle permission avec le nom fourni dans la requête
        Permission::create([
            'name' => $request->name
        ]);

        // Redirige vers la liste des permissions avec un message de succès
        return redirect()->route('permissions.index')->with('status', 'Permission créée avec succès');
    }

    /**
     * Affiche le formulaire de modification d'une permission.
     */
    public function edit(Permission $permission)
    {
        // Retourne la vue 'permissions.update' avec la permission à modifier
        return view('permissions.update', compact('permission'));
    }

    /**
     * Met à jour une permission existante.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        // Met à jour le nom de la permission avec le nouveau nom fourni dans la requête
        $permission->update([
            'name' => $request->name,
        ]);

        // Redirige vers la liste des permissions avec un message de succès
        return redirect()->route('permissions.index')->with('status', 'Permission modifiée avec succès');
    }

    /**
     * Supprime une permission.
     */
    public function destroy($id)
    {
        // Trouve la permission par son ID ou échoue si elle n'existe pas
        $permission = Permission::findOrFail($id);

        // Supprime la permission
        $permission->delete();

        // Redirige vers la liste des permissions avec un message de succès
        return redirect()->route('permissions.index')->with('status', 'Permission supprimée avec succès');
    }
}
