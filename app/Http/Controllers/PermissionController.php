<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StorePermissionRequest;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    public function store(StorePermissionRequest $request)
    {
        Permission::create([
            'name' => $request->name
        ]);

        return redirect()->route('permissions.index')->with('status', 'Permission créée avec succès');
    }
}
