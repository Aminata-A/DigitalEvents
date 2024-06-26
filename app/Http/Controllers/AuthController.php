<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserSimpeInscriptionRequest;

class AuthController extends Controller
{
    // Méthode pour afficher le formulaire d'inscription
    public function showRegistrationFormUser()
    {
        return view('authentifications.users.inscription');
    }

    public function registerUser(UserSimpeInscriptionRequest $request)
    {
        $validatedData = $request->validated();

        $logo = $request->file('logo')->store('logo', 'public');

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone' => $validatedData['phone'],
            'logo' => $validatedData['logo'],
        ]);

        return redirect(route('login'));
    }

    public function showLoginForm()
    {
        return view('authentifications.users.login');
    }

    public function login(LoginRequest $request)
    {
        // Les données sont déjà validées par LoginRequest
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Vérifier le rôle de l'utilisateur
            // $user = Auth::user();
            // if ($user->role === 'personnel') {
            //     // Rediriger l'administrateur vers le tableau de bord administrateur
            //     return redirect()->intended('/dashboard');
            // } else {
            //     // 
            // }
            // Rediriger l'utilisateur vers la page d'accueil
            return redirect()->intended('/');
        }

        // Authentification échouée, rediriger avec une erreur
        return back()->withErrors([
            'email' => 'Email invalide !',
            'password' => 'Mot de passe incorrect !',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }

    public function showRegistrationFormAssociation()
    {
        return view('authentifications.associations.inscription');
    }
}
