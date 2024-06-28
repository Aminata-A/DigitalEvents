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
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function store(StoreRoleRequest $request)
    {
        Role::create([
            'name' => $request->name
        ]);

        return redirect()->route('roles.index')->with('status', 'Rôle créée avec succès');
    }

    public function edit(Role $role)
    {

        return view('roles.update', compact('role'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name,
        ]);

        return redirect()->route('roles.index')->with('status', 'Rôle modifié avec succès');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
    
        return redirect()->route('roles.index')->with('status', 'role supprimée avec succès');
    }

    public function addPermissionToRole($id)
    {
        $permissions = Permission::all();
        $role = Role::findOrFail($id);
        $rolePermission = DB::table('role_has_permissions')
                                    ->where('role_has_permissions.role_id', $role->id)
                                    ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                                    ->all();

        return view('roles.role-permissions', compact('role', 'permissions', 'rolePermission'));
    }

    public function givePermissionToRole(Request $request, $id)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($id);
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('status', 'Permissions bien ajoutées au rôle');
    }
}
