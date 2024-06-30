<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Evenement;
use Illuminate\Http\Request;
use App\Models\EvenementUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
    
    // Méthode pour afficher les événements de l'utilisateur connecté
    public function mesEvenements()
    {
        $user = Auth::user();
        // Assurez-vous que 'user' est correctement chargé avec 'with()'
        $evenements = Evenement::where('user_id', $user->id)->with('user')->get();
    
        return view('evenements.mes-evenements', compact('evenements'));
    }
    
    public function create()
    {
        return view('evenements.create');
    }
    
    public function creation(StoreEvenementRequest $request)
{
    $validatedData = $request->validated();
    
    if ($request->hasFile('image')) {
        $image = $request->file('image')->store('images', 'public');
        $validatedData['image'] = $image;
    }
    
    $user = Auth::user();

    // Vérifier l'état de validation et le statut du compte de l'utilisateur
    if ($user->validation_status !== 'valid') {
        return Redirect::back()->withErrors(['message' => 'Votre compte est en attente de validation par l\'administrateur. Veuillez patienter pour publier un événement.']);
    }

    if ($user->account_status !== 'activated') {
        return Redirect::back()->withErrors(['message' => 'Votre compte est actuellement désactivé. Veuillez contacter l\'administrateur pour activer votre compte avant de publier un événement.']);
    }
    
    // Ajouter les valeurs par défaut
    $validatedData['user_id'] = Auth::id(); // Récupérer l'ID de l'utilisateur connecté
    $validatedData['validation_status'] = 'valid';
    $validatedData['account_status'] = 'activated';
    
    Evenement::create($validatedData);
    
    return redirect()->route('evenement')->with('success', 'Événement créé avec succès!');
}
    
    public function show(Evenement $evenement)
    {
        //
    }
    
    public function edit(Evenement $evenement)
    {
        return view('evenements.update', compact('evenement'));
    }
    
    public function modifier(UpdateEvenementRequest $request, Evenement $evenement)
    {
        $validatedData = $request->validated();
        
        $evenement = Evenement::findOrFail(1);
        
        $evenement->name = $request->input('name');
        $evenement->event_start_date = $request->input('event_start_date');
        $evenement->event_end_date = $request->input('event_end_date');
        $evenement->registration_deadline = $request->input('registration_deadline');
        $evenement->location = $request->input('location');
        $evenement->places = $request->input('places');
        $evenement->description = $request->input('description');
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = storage_path('images');
            $image->move($path, $filename);
            $evenement->image = 'images/' . $filename;
        }
        
        $evenement->save();
        
        return redirect()->route('evenement')->with('success', 'Événement modifié avec succès'); 
    }
    
    public function update(UpdateEvenementRequest $request, Evenement $evenement)
    {
        //
    }
    public function supprimer(Evenement $evenement){
        // Supprimer l'image associée à l'événement s'il en existe une
        if ($evenement->image) {
            Storage::disk('public')->delete($evenement->image);
        }
        
        // Supprimer l'événement de la base de données
        $evenement->delete();
        
        return redirect()->route('evenement')->with('success', 'Événement supprimé avec succès');
    }
}

// public function destroy(Evenement $evenement)
// {
//     //
// }

