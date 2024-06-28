<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function profilAdmin()
    {
        return view('users.profil');
    }

    public function dashboardAdmin()
    {
        return view('users.dashboard');
    }

    public function show($user)
    {
        $user = User::findOrFail($user);
        return view('users.detail', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'required',
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('status', 'Le rôle du user modifié avec succès');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    
        return redirect()->route('users.index')->with('status', 'utilisateur supprimée avec succès');
    }

    public function validateAccount($id)
    {
        $user = User::find($id);
        $user->validation_status = 'valid';
        $user->save();

        return redirect()->back()->with('success', 'Compte validé avec succès.');
    }

    public function invalidateAccount($id)
    {
        $user = User::find($id);
        $user->validation_status = 'invalid';
        $user->save();

        return redirect()->back()->with('success', 'Compte invalidé avec succès.');
    }

    public function activateAccount($id)
    {
        $user = User::find($id);
        $user->account_status = 'activated';
        $user->save();

        return redirect()->back()->with('success', 'Compte activé avec succès.');
    }

    public function deactivateAccount($id)
    {
        $user = User::find($id);
        $user->account_status = 'disabled';
        $user->save();

        return redirect()->back()->with('success', 'Compte désactivé avec succès.');
    }
}
