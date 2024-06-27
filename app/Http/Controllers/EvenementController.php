<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\EvenementUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreEvenementRequest;
use App\Http\Requests\UpdateEvenementRequest;
use App\Models\User; // Assurez-vous d'importer App\Models\User
use Illuminate\Http\Request; // Assurez-vous d'importer Illuminate\Http\Request

class EvenementController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $evenements = Evenement::with(['user'])->get();
        return view('evenements.index', compact('evenements'));
    }    
    public function accueil(Request $request)
    {
        $query = Evenement::with(['user']);
        
        // Filtrer par secteur d'activité si le paramètre est présent
        if ($request->has('activity_area')) {
            $query->whereHas('user', function ($query) use ($request) {
                $query->where('activity_area', $request->activity_area);
            });
        }
        
        $evenements = $query->get();
        $activity_areas = User::pluck('activity_area')->unique();
        
        return view('accueils.accueil', compact('evenements', 'activity_areas'));
    }
    
    
    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {
        return view('evenements.create');
    }
    public function creation(StoreEvenementRequest $request){
        $validatedData = $request->validated();
    
        // Gestion de l'upload d'image
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $image;
        }
        
        // Ajout de l'utilisateur connecté
        $validatedData['user_id'] = 1; // Utilisateur statique pour le moment
        
        // Création de l'événement dans la base de données
        Evenement::create($validatedData);
        
        // Redirection après création
        return redirect()->route('accueil')->with('success', 'Événement créé avec succès!');
    }
    
    /**
    * Store a newly created resource in storage.
    */
    public function store()
{


   
}

    
    
    
    /**
    * Display the specified resource.
    */
    public function show(Evenement $evenement)
    {
        //
    }
    
    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Evenement $evenement)
    {
        //
    }
    
    /**
    * Update the specified resource in storage.
    */
    public function update(UpdateEvenementRequest $request, Evenement $evenement)
    {
        
    }
    
    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Evenement $evenement)
    {
        //
    }
}
