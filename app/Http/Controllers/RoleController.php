<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Affiche la liste de tous les rôles.
     */
    public function index()
    {
        // Récupère tous les rôles
        $roles = Role::all();

        // Retourne la vue avec les rôles
        return view('roles.index', compact('roles'));
    }

    /**
     * Crée un nouveau rôle.
     */
    public function store(StoreRoleRequest $request)
    {
        // Crée un nouveau rôle avec le nom fourni
        Role::create([
            'name' => $request->name
        ]);

        // Redirige avec un message de succès
        return redirect()->route('roles.index')->with('status', 'Rôle créé avec succès');
    }

    /**
     * Affiche le formulaire de modification d'un rôle.
     */
    public function edit(Role $role)
    {
        // Retourne la vue de mise à jour avec le rôle
        return view('roles.update', compact('role'));
    }

    /**
     * Met à jour un rôle existant.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        // Met à jour le nom du rôle
        $role->update([
            'name' => $request->name,
        ]);

        // Redirige avec un message de succès
        return redirect()->route('roles.index')->with('status', 'Rôle modifié avec succès');
    }

    /**
     * Supprime un rôle.
     */
    public function destroy($id)
    {
        // Trouve le rôle par son ID
        $role = Role::findOrFail($id);

        // Liste des rôles protégés qui ne doivent pas être supprimés
        $protectedRoles = ['admin', 'association', 'user'];

        // Vérifie si le rôle est protégé
        if (in_array($role->name, $protectedRoles)) {
            return redirect()->route('roles.index')->with('error', 'Ce rôle ne peut pas être supprimé.');
        }

        // Supprime le rôle
        $role->delete();

        // Redirige avec un message de succès
        return redirect()->route('roles.index')->with('status', 'Rôle supprimé avec succès.');
    }

    /**
     * Affiche le formulaire pour ajouter des permissions à un rôle.
     */
    public function addPermissionToRole($id)
    {
        // Récupère toutes les permissions
        $permissions = Permission::all();

        // Trouve le rôle par son ID
        $role = Role::findOrFail($id);

        // Récupère les permissions actuelles du rôle
        $rolePermission = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        // Retourne la vue avec le rôle, les permissions et les permissions actuelles du rôle
        return view('roles.role-permissions', compact('role', 'permissions', 'rolePermission'));
    }

    /**
     * Ajoute des permissions à un rôle.
     */
    public function givePermissionToRole(Request $request, $id)
    {
        // Valide que la permission est fournie
        $request->validate([
            'permission' => 'required'
        ]);

        // Trouve le rôle par son ID
        $role = Role::findOrFail($id);

        // Synchronise les permissions du rôle
        $role->syncPermissions($request->permission);

        // Redirige avec un message de succès
        return redirect()->back()->with('status', 'Permissions bien ajoutées au rôle');
    }
}
