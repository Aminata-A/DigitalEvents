<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Evenement;
use Illuminate\Http\Request;
use App\Models\EvenementUser;
use App\Mail\ReservationDeclined;
use App\Mail\ReservationConfirmed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreEvenementRequest;
use App\Http\Requests\UpdateEvenementRequest;
use Vinkla\Hashids\Facades\Hashids;

class EvenementController extends Controller
{
    /**
     * Affiche la liste des événements avec les places restantes.
     */
    public function index()
    {
        // Récupère les événements avec l'utilisateur associé et calcule les places restantes
        $evenements = Evenement::with(['user'])->get()->map(function ($evenement) {
            $evenement->remaining_places = $evenement->places - EvenementUser::where('evenement_id', $evenement->id)->count();
            return $evenement;
        });

        // Retourne la vue avec les événements
        return view('evenements.index', compact('evenements'));
    }

    /**
     * Affiche la page d'accueil avec tous les événements.
     */
    public function accueil()
    {
        // Récupère tous les événements
        $evenements = Evenement::all();

        // Retourne la vue d'accueil avec les événements
        return view('accueils.accueil', compact('evenements'));
    }

    /**
     * Filtre et affiche les événements par domaine d'activité.
     */
    public function evenement(Request $request)
    {
        // Prépare la requête pour récupérer les événements avec l'utilisateur associé
        $query = Evenement::with(['user']);

        // Filtre les événements par domaine d'activité si fourni dans la requête
        if ($request->has('activity_area')) {
            $query->whereHas('user', function ($query) use ($request) {
                $query->where('activity_area', $request->activity_area);
            });
        }

        // Récupère les événements et calcule les places restantes
        $evenements = $query->get()->map(function ($evenement) {
            $evenement->remaining_places = $evenement->places - EvenementUser::where('evenement_id', $evenement->id)->count();
            return $evenement;
        });

        // Récupère les domaines d'activité uniques
        $activity_areas = User::pluck('activity_area')->unique();

        // Retourne la vue avec les événements et les domaines d'activité
        return view('evenements.index', compact('evenements', 'activity_areas'));
    }

    /**
     * Affiche les détails d'un événement spécifique.
     */
    public function evenementDetail($hashid)
    {
        // Décode l'ID de l'événement à partir du hashid
        $id = Hashids::decode($hashid)[0];

        // Récupère l'événement avec l'utilisateur associé
        $evenement = Evenement::with(['user'])->findOrFail($id);

        // Calcule les places restantes
        $remaining_places = $evenement->places - EvenementUser::where('evenement_id', $evenement->id)->count();

        // Récupère les réservations pour l'événement
        $reservations = EvenementUser::where('evenement_id', $evenement->id)->with('user')->get();

        // Vérifie si l'utilisateur est authentifié
        if (Auth::check()) {
            $user = Auth::user();

            // Vérifie si l'utilisateur est l'organisateur de l'événement
            if ($evenement->user_id == $user->id) {

                $evenement = Evenement::with(['users' => function ($query) {
                    $query->wherePivot('status', 'accepted');
                }])->find($id);

                // Vérifie si l'événement existe
                if (!$evenement) {
                    abort(404); // Ou gérer le cas de non trouvé d'une autre manière
                }

                // Récupère les réservations acceptées de l'événement
                $reservations = $evenement->users;

                // Retourne la vue pour l'organisateur avec les données de l'événement
                return view('evenements.show', compact('evenement', 'remaining_places', 'reservations'));
            } else {
                // Retourne la vue pour un utilisateur normal avec les données de l'événement
                return view('evenements.detail', compact('evenement', 'remaining_places'));
            }
        }

        // Retourne la vue pour un utilisateur normal avec les données de l'événement
        return view('evenements.detail', compact('evenement', 'remaining_places'));
    }

    /**
     * Réserve une place pour un événement.
     */
    public function reserver($id)
    {
        // Vérifie si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->back()->withErrors(['message' => 'Vous devez être connecté pour réserver.']);
        }

        $userId = Auth::id();

        // Vérifie si l'utilisateur a déjà réservé pour cet événement
        $existingReservation = EvenementUser::where('evenement_id', $id)
            ->where('user_id', $userId)
            ->first();

        if ($existingReservation) {
            return redirect()->back()->withErrors(['message' => 'Vous avez déjà réservé pour cet événement.']);
        }

        // Récupère l'événement
        $evenement = Evenement::findOrFail($id);

        // Vérifie s'il y a des places disponibles
        $remaining_places = $evenement->places - EvenementUser::where('evenement_id', $id)->count();
        if ($remaining_places <= 0) {
            return redirect()->back()->withErrors(['message' => 'Aucune place disponible.']);
        }

        // Crée une nouvelle réservation
        $reservation = EvenementUser::create([
            'evenement_id' => $id,
            'user_id' => $userId,
        ]);

        // Envoie l'email de confirmation
        Mail::to(Auth::user()->email)->send(new ReservationConfirmed($reservation));

        // Redirige avec un message de succès
        return redirect()->back()->with('reservation_success', 'Réservation faite avec succès.');
    }

    /**
     * Affiche les événements de l'utilisateur connecté.
     */
    public function mesEvenements()
    {
        // Récupère l'utilisateur authentifié
        $user = Auth::user();

        // Vérifie si l'utilisateur est une association
        if ($user->hasRole('association')) {
            // Récupère les événements créés par cette association
            $evenements = Evenement::where('user_id', $user->id)->get();
        } else {
            // Récupère les événements auxquels l'utilisateur a participé
            $evenements = EvenementUser::where('user_id', $user->id)->with('evenement')->get();
        }

        // Retourne la vue avec les événements de l'utilisateur
        return view('evenements.mes-evenements', compact('evenements'));
    }

    /**
     * Affiche le formulaire de création d'un événement.
     */
    public function create()
    {
        // Retourne la vue de création d'un événement
        return view('evenements.create');
    }

    /**
     * Crée un nouvel événement.
     */
    public function creation(StoreEvenementRequest $request)
    {
        // Vérifie si l'utilisateur a le rôle "association"
        if (!Auth::user()->hasRole('association')) {
            return redirect()->route('home')->with('error', 'Vous n\'avez pas les permissions nécessaires pour créer un événement.');
        }

        // Valide les données du formulaire
        $validatedData = $request->validated();

        // Gère le téléchargement de l'image
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $image;
        }

        $user = Auth::user();

        // Vérifie l'état de validation et le statut du compte de l'utilisateur
        if ($user->validation_status !== 'valid') {
            return Redirect::back()->withErrors(['message' => "Votre compte est en attente de validation par l'administrateur. Veuillez patienter pour publier un événement."]);
        }

        if ($user->account_status !== 'activated') {
            return Redirect::back()->withErrors(['message' => "Votre compte est actuellement désactivé. Veuillez contacter l'administrateur pour activer votre compte avant de publier un événement."]);
        }

        // Ajoute les valeurs par défaut
        $validatedData['user_id'] = Auth::id(); // Récupère l'ID de l'utilisateur connecté
        $validatedData['validation_status'] = 'valid';
        $validatedData['account_status'] = 'activated';

        // Crée l'événement
        Evenement::create($validatedData);

        // Redirige avec un message de succès
        return redirect()->route('evenement')->with('success', 'Événement créé avec succès!');
    }

    /**
     * Affiche les réservations de l'utilisateur connecté.
     */
    public function reservations()
    {
        // Récupère l'utilisateur authentifié
        $user = Auth::user();

        // Récupère les réservations de l'utilisateur avec les événements associés, ordonnées par date de création
        $reservations = EvenementUser::where('user_id', $user->id)
            ->with('evenement') // Charge la relation avec l'événement
            ->orderBy('created_at', 'desc') // Ordonne par date de création
            ->get();

        // Retourne la vue avec les réservations
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Affiche le formulaire de création de réservation.
     */
    public function createReservation()
    {
        // Récupère la liste des événements disponibles pour la réservation
        $evenements = Evenement::all();

        // Récupère la liste des utilisateurs si nécessaire
        $users = User::all();

        // Retourne la vue de création de réservation avec les événements et les utilisateurs
        return view('reservations.create', compact('evenements', 'users'));
    }
}
