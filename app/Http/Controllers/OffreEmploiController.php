<?php

namespace App\Http\Controllers;

use App\Models\OffreEmploi;
use App\Models\Employe; // Importer Employe pour la liste des recruteurs
use Illuminate\Http\Request; // Utiliser la requête standard

class OffreEmploiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = OffreEmploi::with('recruiter')->latest(); // Charger la relation recruteur

        // Filtrage par département
        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        // Filtrage par statut
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $offres = $query->paginate(10)->withQueryString(); // Conserver les filtres dans la pagination

        // Récupérer les départements et statuts uniques pour les filtres
        $departments = OffreEmploi::select('department')->distinct()->orderBy('department')->pluck('department');
        $statuses = ['brouillon', 'publiee', 'fermee']; // Ou OffreEmploi::select('status')->distinct()->pluck('status');

        return view('offres.index', compact('offres', 'departments', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Récupérer tous les employés pour le dropdown "recruteur"
        $recruiters = Employe::where('status', 'actif')->orderBy('name')->get(); // On ne prend que les actifs ? A définir.
        return view('offres.create', compact('recruiters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validation simple
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'salary_range' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'status' => 'required|in:brouillon,publiee,fermee',
            'recruiter_id' => 'required|exists:employes,id', // Vérifie que l'employé existe
            'deadline' => 'required|date|after_or_equal:today',
        ]);

        OffreEmploi::create($validatedData);

        return redirect()->route('offres.index')
                         ->with('success', 'Offre d\'emploi créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OffreEmploi $offre) // Laravel injecte l'objet basé sur l'ID dans l'URL
    {
        // Charger explicitement la relation si nécessaire (bonne pratique)
        $offre->load('recruiter');

        // Retourne la vue 'show' en lui passant l'offre récupérée
        return view('offres.show', compact('offre'));
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OffreEmploi $offre) // Utilise le Route Model Binding
    {
        $recruiters = Employe::where('status', 'actif')->orderBy('name')->get();
        return view('offres.edit', compact('offre', 'recruiters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OffreEmploi $offre)
    {
        // Validation simple
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'salary_range' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'status' => 'required|in:brouillon,publiee,fermee',
            'recruiter_id' => 'required|exists:employes,id',
            'deadline' => 'required|date|after_or_equal:today',
        ]);

        $offre->update($validatedData);

        return redirect()->route('offres.index')
                         ->with('success', 'Offre d\'emploi mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OffreEmploi $offre)
    {
        $offre->delete();
        return redirect()->route('offres.index')
                         ->with('success', 'Offre d\'emploi supprimée avec succès.');
    }
}