<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Evenement;
use Illuminate\Http\Request;
use App\Models\EvenementUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreEvenementUserRequest;
use App\Http\Requests\UpdateEvenementUserRequest;

class EvenementUserController extends Controller
{
    /**
     * Affiche la liste des réservations.
     */
    /**
     * Affiche les réservations de l'utilisateur connecté.
     */
    public function index()
    {
        $user = Auth::user();
        $reservations = EvenementUser::where('user_id', $user->id)
                        ->with('evenement') // Charger la relation avec l'événement
                        ->orderBy('created_at', 'desc') // Ordonner par date de création par exemple
                        ->get();
    
        return view('reservations.index', compact('reservations'));
    }
    /**
     * Affiche le formulaire de création de réservation.
     */
    public function create()
    {
        //
    }

    /**
     * Enregistre une nouvelle réservation.
     */
   /**
     * Crée une réservation pour l'utilisateur connecté.
     */
    public function store(Request $request)
    {
        // 
    }

    /**

    * Display the specified resource.
    */
    public function show($id)
    {
        // 
    }

    /**
     * Affiche le formulaire pour modifier une réservation.
     */
    public function edit(EvenementUser $evenementUser)
    {
       //
    }

    /**
     * Met à jour une réservation existante.
     */
    public function update(Request $request, EvenementUser $reservation)
    {
        // 
    }

    /**
     * Supprime une réservation spécifique.
     */
    public function destroy(EvenementUser $evenementUser)
    {
        // 
    }
}
