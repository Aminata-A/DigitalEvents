<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Méthode pour afficher le formulaire d'inscription
    public function showRegistrationForm()
    {
        return view('authentifications.users.inscription');
    }
}
