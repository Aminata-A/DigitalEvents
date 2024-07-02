<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Evenement;
use Illuminate\Http\Request;
use App\Models\EvenementUser;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        // $userId = Auth::id();
    
        // // Ensure you use the correct pivot table name: `evenement_user` or `evenement_users`
        // $exists = DB::table('evenement_users')
        //     ->where('evenement_id', $id)
        //     ->where('user_id', $userId)
        //     ->exists();
    
         $evenement = Evenement::findOrFail($id);

        // Vérifiez si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->route('evenement.show', $id)->withErrors(['Vous devez être connecté pour réserver.']);
        }

        $user = Auth::user();

        // Vérifiez si l'utilisateur a déjà réservé pour cet événement
        if ($evenement->users()->where('user_id', $user->id)->exists()) {
            return redirect()->route('evenement.show', $id)->withErrors(['Vous avez déjà réservé pour cet événement.']);
        }

        // Vérifiez si des places sont disponibles
        $remaining_places = $evenement->places - $evenement->users()->count();
        if ($remaining_places <= 0) {
            return redirect()->route('evenement.show', $id)->withErrors(['Aucune place disponible.']);
        }

        // Ajoutez l'utilisateur à l'événement
        $evenement->users()->attach($user->id);

        return redirect()->route('evenement.show', $id)->with('reservation_success', 'Réservation faite avec succès.');
    }
    
    public function mesEvenements()
    {
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
    
    public function edit(Evenement $evenement)
    {
        return view('evenements.update', compact('evenement'));
    }
    
    public function modifier(UpdateEvenementRequest $request, Evenement $evenement)
    {
        $validatedData = $request->validated();
        
        $evenement->update($validatedData);
        
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($evenement->image);
            $image = $request->file('image')->store('images', 'public');
            $evenement->image = $image;
        }
        
        $evenement->save();
        
        return redirect()->route('evenement')->with('success', 'Événement modifié avec succès'); 
    }
    
    public function supprimer(Evenement $evenement)
    {
        if ($evenement->image) {
            Storage::disk('public')->delete($evenement->image);
        }
        
        $evenement->delete();
        
        return redirect()->route('evenement')->with('success', 'Événement supprimé avec succès');
    }
}
