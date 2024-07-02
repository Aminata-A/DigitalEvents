<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;

class PermissionController extends Controller
{
    public function index()
{
    $permissions = Permission::paginate(6);
    return view('permissions.index', compact('permissions'));
}


    public function store(StorePermissionRequest $request)
    {
        Permission::create([
            'name' => $request->name
        ]);

        return redirect()->route('permissions.index')->with('status', 'Permission créée avec succès');
    }

    public function edit(Permission $permission)
    {

        return view('permissions.update', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update([
            'name' => $request->name,
        ]);

        return redirect()->route('permissions.index')->with('status', 'Permission modifiée avec succès');
    }
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
    
        return redirect()->route('permissions.index')->with('status', 'Permission supprimée avec succès');
    }
}
