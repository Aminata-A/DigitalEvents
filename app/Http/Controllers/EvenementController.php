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
        $reservations = EvenementUser::where('evenement_id', $evenement->id)->with('user')->get();
        
        // Vérifier si l'utilisateur est authentifié
        if (Auth::check()) {
            $user = Auth::user();
            // Vérifier si l'utilisateur est l'organisateur de l'événement
            if ($evenement->user_id == $user->id) {
                
                $evenement = Evenement::with(['users' => function ($query) {
                    $query->wherePivot('status', 'accepted');
                }])->find($id);
                
                // Vérifier si l'événement existe
                if (!$evenement) {
                    abort(404); // Ou gérer le cas de non trouvé d'une autre manière
                }
                
                // Récupérer les réservations de l'événement à travers les utilisateurs avec statut 'accepted'
                $reservations = $evenement->users;
                // Rediriger vers la vue pour l'organisateur
                return view('evenements.show', compact('evenement', 'remaining_places', 'reservations'));
            } else {
                // Rediriger vers la vue pour un utilisateur normal
                return view('evenements.detail', compact('evenement', 'remaining_places'));
            }
        }
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
        $reservation = EvenementUser::create([
            'evenement_id' => $id,
            'user_id' => $userId,
        ]);
        
        // Envoyez l'e-mail de confirmation
        Mail::to(Auth::user()->email)->send(new ReservationConfirmed($reservation));
        
        // Redirection avec un message de succès
        return redirect()->back()->with('reservation_success', 'Réservation faite avec succès.');
    }
    
    
    public function mesEvenements()
    {
        // Récupérez l'utilisateur authentifié
        $user = Auth::user();
        
        // Vérifiez si l'utilisateur est une association
        if ($user->hasRole('association')) {
            // Récupérez les événements créés par cette association
            $evenements = Evenement::where('user_id', $user->id)->get();
        } else {
            // Récupérez les événements auxquels l'utilisateur a participé
            $evenements = EvenementUser::where('user_id', $user->id)->with('evenement')->get();
        }
        
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
        
        $user = Auth::user();
        
        // Vérifier l'état de validation et le statut du compte de l'utilisateur
        if ($user->validation_status !== 'valid') {
            return Redirect::back()->withErrors(['message' => "Votre compte est en attente de validation par l'administrateur. Veuillez patienter pour publier un événement."]);
        }
        
        if ($user->account_status !== 'activated') {
            return Redirect::back()->withErrors(['message' => "Votre compte est actuellement désactivé. Veuillez contacter l'administrateur pour activer votre compte avant de publier un événement."]);
        }
        
        // Ajouter les valeurs par défaut
        $validatedData['user_id'] = Auth::id(); // Récupérer l'ID de l'utilisateur connecté
        $validatedData['validation_status'] = 'valid';
        $validatedData['account_status'] = 'activated';
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
    
    //     public function showEvent($evenementId)
    // {
    //     $event = Evenement::findOrFail($evenementId); // Adjust this as per your actual model and method
    //     $reservations = EvenementUser::with('user')->where('evenement_id', $evenementId)->get();
    
    //     return view('your_view_name', compact('event', 'reservations'));
    // }
    
    
    public function decline(Request $request, $evenementId, $userId)
    {
        // Validate the request
        $request->validate([
            'status' => 'required|in:declined',
        ]);
        
        DB::beginTransaction();
        
        try {
            // Find the reservation by user_id and evenement_id
            $reservation = EvenementUser::where('user_id', $userId)
            ->where('evenement_id', $evenementId)
            ->firstOrFail();
            
            if (!$reservation) {
                throw new \Exception('Aucune réservation trouvée pour cet utilisateur et cet événement.');
            }
            
            // Update the reservation status
            $reservation->status = $request->input('status');
            $reservation->save();
            
            // Send notification email to the associated user
            Mail::to($reservation->user->email)->send(new ReservationDeclined($reservation));
            
            DB::commit();
            
            // Return to the previous page with a success message
            return back()->with('success', 'La réservation a été déclinée et un email a été envoyé.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Return to the previous page with an error message
            return back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }
    
    
    
    
    public function edit(Evenement $evenement)
    {
        return view('evenements.update', compact('evenement'));
    }
    
    public function modifier(UpdateEvenementRequest $request, Evenement $evenement)
{
    // Valider les données du formulaire
    $validatedData = $request->validated();
    
    // Gérer le téléchargement de la nouvelle image
    if ($request->hasFile('image')) {
        // Supprimer l'ancienne image si elle existe
        if ($evenement->image && Storage::disk('public')->exists($evenement->image)) {
            Storage::disk('public')->delete($evenement->image);
        }
        // Stocker la nouvelle image
        $imagePath = $request->file('image')->store('images', 'public');
        $validatedData['image'] = $imagePath;
    }
    
    // Mettre à jour l'événement avec les données validées
    $evenement->update($validatedData);
    dd($validatedData);

    // Redirection avec un message de succès
    return redirect()->route('evenement')->with('success', 'Événement modifié avec succès');

}   
    
    
    public function supprimer(Evenement $evenement, $id)
    {
        $evenement = Evenement::find($id);
        
        if (!$evenement) {
            return redirect()->back()->with('error', 'Événement non trouvé');
        }
        
        // Supprimer l'image liée
        if ($evenement->image) {
            Storage::delete($evenement->image);
        }
        
        $evenement->delete();
        
        return redirect()->back()->with('success', 'Événement supprimé avec succès');
    }
    
    
}
