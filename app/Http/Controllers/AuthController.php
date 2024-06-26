<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
    }
}
