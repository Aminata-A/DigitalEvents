<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Méthode pour afficher le formulaire d'inscription
    public function showRegistrationFormUser()
    {
        return view('authentifications.users.inscription');
    }
}
