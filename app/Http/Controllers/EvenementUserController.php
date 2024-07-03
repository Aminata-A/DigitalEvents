<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Evenement;
use Illuminate\Http\Request;
use App\Models\EvenementUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreEvenementUserRequest;
use App\Http\Requests\UpdateEvenementUserRequest;
use Barryvdh\DomPDF\Facade\Pdf;

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
        // Vous pouvez récupérer la liste des événements disponibles pour la réservation
        $evenements = Evenement::all();
        // Vous pouvez également récupérer la liste des utilisateurs si nécessaire
        $users = User::all();
        return view('reservations.create', compact('evenements', 'users'));
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

    public function showAllReservations($id)
{
    // Trouver l'événement correspondant à l'ID
    $evenement = Evenement::find($id);

    // Vérifier si l'événement existe
    if (!$evenement) {
        abort(404); // Ou gérer le cas de non trouvé d'une autre manière
    }

    // Récupérer tous les utilisateurs de l'événement avec statut 'accepted'
    $reservations = $evenement->users()->wherePivot('status', 'accepted')->get();

    // Passer les données à la vue pour l'affichage
    return view('evenements.liste', compact('evenement', 'reservations'));
}

public function downloadReservations($id)
{
    // Trouver l'événement correspondant à l'ID
    $evenement = Evenement::find($id);

    // Vérifier si l'événement existe
    if (!$evenement) {
        abort(404); // Ou gérer le cas de non trouvé d'une autre manière
    }

    // Récupérer tous les utilisateurs de l'événement avec statut 'accepted'
    $reservations = $evenement->users()->wherePivot('status', 'accepted')->get();

    // Générer le PDF
    $pdf = PDF::loadView('evenements.pdf', compact('evenement', 'reservations'));


    // Télécharger le PDF
    return $pdf->stream('reservations.pdf');
}



}
