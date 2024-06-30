<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserSimpeInscriptionRequest;
use App\Http\Requests\AssociationInscriptionRequest;

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

        return redirect()->route('login')->with('success', 'Inscription réussie.');
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

            $user = Auth::user();
            if ($user->hasRole('admin')) {
                return redirect()->intended('/dashboard');
            } elseif($user->hasRole('association')) {
                return redirect()->intended('/evenement');
            }else {
                return redirect()->intended('/');
            }
            
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

    public function registerAssociation(AssociationInscriptionRequest $request)
    {
        $validatedData = $request->validated();

        // Handle the logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validatedData['logo'] = $logoPath;
        }

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone' => $validatedData['phone'],
            'logo' => $validatedData['logo'],
            'description' => $validatedData['description'],
            'adress' => $validatedData['adress'],
            'activity_area' => $validatedData['activity_area'],
            'ninea' => $validatedData['ninea'],
            'creation_date' => $validatedData['creation_date'],
            'account_status' => User::getDefaultAccountStatus(),
            'validation_status' => User::getDefaultValidationStatus()
        ]);

        return redirect()->route('login')->with('success', 'Inscription réussie.');
    }
}
