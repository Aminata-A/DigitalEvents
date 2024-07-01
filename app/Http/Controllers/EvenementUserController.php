<?php

namespace App\Http\Controllers;

use App\Models\EvenementUser;
use App\Http\Requests\StoreEvenementUserRequest;
use App\Http\Requests\UpdateEvenementUserRequest;

class EvenementUserController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {

    }

    public function accueil(){
        $reservations = EvenementUser::with(['user', 'evenement'])->get();
        return view('accueils.accueil', compact('reservations'));
    }

    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    */
    public function store(StoreEvenementUserRequest $request)
    {
        //
    }

    /**
    * Display the specified resource.
    */
    public function show($id)
    {
        // Trouver l'événement correspondant à l'ID
        $evenement = Evenement::with('users')->find($id);

        // Vérifier si l'événement existe
        if (!$evenement) {
            abort(404); // Ou gérer le cas de non trouvé d'une autre manière
        }

        // Récupérer les réservations de l'événement à travers les utilisateurs
        $reservations = $evenement->users->flatMap->reservations;

        // Vérifier si des réservations existent
        if ($reservations) {
            // Passer les données à la vue pour l'affichage
            return view('Evenements.show', compact('evenement', 'reservations'));
        } else {
            // Si aucune réservation n'existe, passer un tableau vide
            return view('Evenements.show', compact('evenement', 'reservations'));
        }
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(EvenementUser $evenementUser)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(UpdateEvenementUserRequest $request, EvenementUser $evenementUser)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    */
    public function destroy(EvenementUser $evenementUser)
    {
        //
    }
}
