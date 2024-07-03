<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Evenement;
use Illuminate\Http\Request;
use App\Models\EvenementUser;
use App\Mail\ReservationDeclined;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreEvenementRequest;
use App\Http\Requests\UpdateEvenementRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

class EvenementController extends Controller
{
    public function index()
    {
        $evenements = Evenement::with(['user'])->get()->map(function ($evenement) {
            $evenement->remaining_places = $evenement->places - EvenementUser::where('evenement_id', $evenement->id)->count();
            return $evenement;
        });
        
        return view('evenements.index', compact('evenements'));
    }
    
    public function accueil()
    {
        $evenements = Evenement::all();
        
        return view('accueils.accueil', compact('evenements'));
    }
    
    public function evenement(Request $request)
    {
        $query = Evenement::with(['user']);
        
        if ($request->has('activity_area')) {
            $query->whereHas('user', function ($query) use ($request) {
                $query->where('activity_area', $request->activity_area);
            });
        }
        
        $evenements = $query->get()->map(function ($evenement) {
            $evenement->remaining_places = $evenement->places - EvenementUser::where('evenement_id', $evenement->id)->count();
            return $evenement;
        });
        
        $activity_areas = User::pluck('activity_area')->unique();
        
        return view('evenements.index', compact('evenements', 'activity_areas'));
    }

    public function evenementDetail($id)
    {
        $evenement = Evenement::with(['user'])->findOrFail($id);
        $remaining_places = $evenement->places - EvenementUser::where('evenement_id', $evenement->id)->count();

        return view('evenements.detail', compact('evenement', 'remaining_places'));
    }

    public function reserver($id)
    {
        // Vérifiez si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->back()->withErrors(['message' => 'Vous devez être connecté pour réserver.']);
        }
        
        $userId = Auth::id();
        
        // Vérifiez si l'utilisateur a déjà réservé pour cet événement
        $existingReservation = EvenementUser::where('evenement_id', $id)
            ->where('user_id', $userId)
            ->first();
        
        if ($existingReservation) {
            return redirect()->back()->withErrors(['message' => 'Vous avez déjà réservé pour cet événement.']);
        }
        
        // Trouvez l'événement
        $evenement = Evenement::findOrFail($id);
        
        // Vérifiez s'il y a des places disponibles
        $remaining_places = $evenement->places - EvenementUser::where('evenement_id', $id)->count();
        if ($remaining_places <= 0) {
            return redirect()->back()->withErrors(['message' => 'Aucune place disponible.']);
        }
        
        // Créez une nouvelle réservation
        EvenementUser::create([
            'evenement_id' => $id,
            'user_id' => $userId,
        ]);
        
        return redirect()->back()->with('reservation_success', 'Réservation faite avec succès.');
    }

    public function mesEvenements()
    {
        // Récupérez l'utilisateur authentifié
        $user = Auth::user();
        $evenements = EvenementUser::where('user_id', $user->id)->with('evenement')->get();

        return view('evenements.mes-evenements', compact('evenements'));
    }
    
    public function create()
    {
        return view('evenements.create');
    }
    
    public function creation(StoreEvenementRequest $request)
    {
        // Vérifie si l'utilisateur a le rôle "association"
        if (!Auth::user()->hasRole('association')) {
            return redirect()->route('home')->with('error', 'Vous n\'avez pas les permissions nécessaires pour créer un événement.');
        }

        $validatedData = $request->validated();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $image;
        }

        $validatedData['user_id'] = Auth::id();

        Evenement::create($validatedData);
        
        return redirect()->route('evenement')->with('success', 'Événement créé avec succès!');
    }
    
    public function show($id)
    {
        // Trouver l'événement correspondant à l'ID
        $evenement = Evenement::with(['users' => function ($query) {
            $query->wherePivot('status', 'accepted');
        }])->find($id);

        // Vérifier si l'événement existe
        if (!$evenement) {
            abort(404); // Ou gérer le cas de non trouvé d'une autre manière
        }

        // Récupérer les réservations de l'événement à travers les utilisateurs avec statut 'accepted'
        $reservations = $evenement->users;

        // Passer les données à la vue pour l'affichage
        return view('evenements.show', compact('evenement', 'reservations'));
    }

    public function decline(Request $request, $id)
    {
        // Valider la requête
        $request->validate([
            'status' => 'required|in:declined',
        ]);

        DB::beginTransaction();

        try {
            // Trouver la réservation par son ID (user_id dans votre cas)
            $reservation = EvenementUser::where('user_id', $id)->firstOrFail();
            
            if (!$reservation) {
                throw new \Exception('Aucune réservation trouvée pour cet utilisateur.');
            }

            // Mettre à jour le statut de la réservation
            $reservation->status = $request->input('status');
            $reservation->save();
            
            // Envoyer l'email de notification à l'utilisateur associé
            Mail::to($reservation->user->email)->send(new ReservationDeclined($reservation));

            DB::commit();

            // Retourner à la page précédente avec un message de succès
            return back()->with('success', 'La réservation a été déclinée et un email a été envoyé.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Retourner à la page précédente avec un message d'erreur
            return back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    public function edit(Evenement $evenement)
    {
        return view('evenements.update', compact('evenement'));
    }
    
    public function modifier(UpdateEvenementRequest $request, Evenement $evenement)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($evenement->image) {
                Storage::disk('public')->delete($evenement->image);
            }
            // Stocker la nouvelle image
            $image = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $image;
        }

        $evenement->update($validatedData);

        return redirect()->route('evenement')->with('success', 'Événement modifié avec succès');
    }

    public function supprimer(Evenement $evenement)
    {
        if ($evenement->image) {
            Storage::disk('public')->delete($evenement->image);
        }
        
        // Supprimer l'événement de la base de données
        $evenement->delete();
        
        return redirect()->route('evenement')->with('success', 'Événement supprimé avec succès');
    }
}
