<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request; // Utilisez la requête standard pour la simplicité du test

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employes = Employe::latest()->paginate(10); // Récupère les employés paginés
        return view('employes.index', compact('employes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation simple (pour un vrai projet, utiliser Form Request)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employes',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'salary' => 'nullable|numeric|min:0',
            'status' => 'required|in:actif,en_conge,licencie',
        ]);

        Employe::create($validatedData);

        return redirect()->route('employes.index')
                         ->with('success', 'Employé ajouté avec succès.');
    }

    /**
     * Display the specified resource. (Non demandé explicitement, mais utile)
     */
    public function show(Employe $employe)
    {
        // Retourne la vue 'show' en lui passant l'employé récupéré par Route Model Binding
        return view('employes.show', compact('employe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employe $employe)
    {
        return view('employes.edit', compact('employe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employe $employe)
    {
        // Validation simple
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // Attention à l'email unique lors de la mise à jour
            'email' => 'required|string|email|max:255|unique:employes,email,' . $employe->id,
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'salary' => 'nullable|numeric|min:0',
            'status' => 'required|in:actif,en_conge,licencie',
        ]);

        $employe->update($validatedData);

        return redirect()->route('employes.index')
                         ->with('success', 'Employé mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employe $employe)
    {
        try {
            $employe->delete();
            return redirect()->route('employes.index')
                             ->with('success', 'Employé supprimé avec succès.');
        } catch (\Illuminate\Database\QueryException $e) {
             // Gérer le cas où l'employé est recruteur et la suppression est empêchée par une contrainte FK
             // Sauf si onDelete('cascade') est utilisé
             return redirect()->route('employes.index')
                             ->with('error', 'Impossible de supprimer cet employé car il est lié à des offres d\'emploi. Supprimez d\'abord les offres associées ou utilisez onDelete Cascade.');
        }
    }
}