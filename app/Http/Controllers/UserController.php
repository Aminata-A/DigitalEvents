<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Affiche la liste paginée des utilisateurs.
     */
    public function index()
    {
        // Récupère les utilisateurs avec une pagination de 6 par page
        $users = User::paginate(6);

        // Retourne la vue avec les utilisateurs
        return view('users.index', compact('users'));
    }

    /**
     * Affiche le profil de l'administrateur connecté.
     */
    public function profilAdmin()
    {
        // Récupère l'utilisateur actuellement connecté
        $user = auth()->user();

        // Retourne la vue du profil avec l'utilisateur
        return view('users.profil', compact('user'));
    }

    /**
     * Affiche le tableau de bord de l'administrateur.
     */
    public function dashboardAdmin()
    {
        // Récupère le nombre d'associations validées
        $validatedAssociationsCount = User::role('association')->where('validation_status', 'valid')->count();

        // Récupère le nombre d'associations en attente de validation
        $pendingAssociationsCount = User::role('association')->where('validation_status', 'invalid')->count();

        // Récupère le nombre d'utilisateurs ayant le rôle 'user'
        $usersCount = User::role('user')->count();

        // Récupère le nombre total d'événements
        $eventsCount = Evenement::count();

        // Retourne la vue du tableau de bord avec les données récupérées
        return view('users.dashboard', compact('validatedAssociationsCount', 'pendingAssociationsCount', 'usersCount', 'eventsCount'));
    }

    /**
     * Affiche les détails d'un utilisateur.
     */
    public function show($user)
    {
        // Trouve l'utilisateur par son ID ou lève une exception s'il n'est pas trouvé
        $user = User::findOrFail($user);

        // Retourne la vue des détails avec l'utilisateur
        return view('users.detail', compact('user'));
    }

    /**
     * Affiche le formulaire de modification d'un utilisateur.
     */
    public function edit(User $user)
    {
        // Récupère tous les rôles disponibles
        $roles = Role::pluck('name', 'name')->all();

        // Récupère les rôles de l'utilisateur
        $userRole = $user->roles->pluck('name', 'name')->all();

        // Retourne la vue de modification avec l'utilisateur et ses rôles
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Met à jour les rôles d'un utilisateur.
     */
    public function update(Request $request, User $user)
    {
        // Valide que les rôles sont fournis
        $request->validate([
            'roles' => 'required',
        ]);

        // Synchronise les rôles de l'utilisateur
        $user->syncRoles($request->roles);

        // Redirige avec un message de succès
        return redirect()->route('users.index')->with('status', 'Le rôle de l\'utilisateur modifié avec succès');
    }

    /**
     * Supprime un utilisateur.
     */
    public function destroy($id)
    {
        // Trouve l'utilisateur par son ID ou lève une exception s'il n'est pas trouvé
        $user = User::findOrFail($id);

        // Supprime l'utilisateur
        $user->delete();

        // Redirige avec un message de succès
        return redirect()->route('users.index')->with('status', 'Utilisateur supprimé avec succès');
    }

    /**
     * Valide le compte d'un utilisateur.
     */
    public function validateAccount($id)
    {
        // Trouve l'utilisateur par son ID
        $user = User::find($id);

        // Change le statut de validation de l'utilisateur à 'valid'
        $user->validation_status = 'valid';

        // Sauvegarde les changements
        $user->save();

        // Redirige avec un message de succès
        return redirect()->back()->with('success', 'Compte validé avec succès.');
    }

    /**
     * Invalide le compte d'un utilisateur.
     */
    public function invalidateAccount($id)
    {
        // Trouve l'utilisateur par son ID
        $user = User::find($id);

        // Change le statut de validation de l'utilisateur à 'invalid'
        $user->validation_status = 'invalid';

        // Sauvegarde les changements
        $user->save();

        // Redirige avec un message de succès
        return redirect()->back()->with('success', 'Compte invalidé avec succès.');
    }

    /**
     * Active le compte d'un utilisateur.
     */
    public function activateAccount($id)
    {
        // Trouve l'utilisateur par son ID
        $user = User::find($id);

        // Change le statut du compte de l'utilisateur à 'activated'
        $user->account_status = 'activated';

        // Sauvegarde les changements
        $user->save();

        // Redirige avec un message de succès
        return redirect()->back()->with('success', 'Compte activé avec succès.');
    }

    /**
     * Désactive le compte d'un utilisateur.
     */
    public function deactivateAccount($id)
    {
        // Trouve l'utilisateur par son ID
        $user = User::find($id);

        // Change le statut du compte de l'utilisateur à 'disabled'
        $user->account_status = 'disabled';

        // Sauvegarde les changements
        $user->save();

        // Redirige avec un message de succès
        return redirect()->back()->with('success', 'Compte désactivé avec succès.');
    }
}
