<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filiere;
class FiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $filieres = Filiere::all();
        return view('filieres.index', compact('filieres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('filieres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'nom' => 'required|unique:filieres,nom|max:255'
        ]);

        Filiere::create($request->all());

        return redirect()->route('filieres.index')->with('success', 'Filière ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Filiere $filiere)
    {
        return view('filieres.edit', compact('filiere'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Filiere $filiere)
    {
         $request->validate([
            'nom' => 'required|unique:filieres,nom,' . $filiere->id . '|max:255'
        ]);

        $filiere->update($request->all());

        return redirect()->route('filieres.index')->with('success', 'Filière mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filiere $filiere)
    {
           $filiere->delete();

        return redirect()->route('filieres.index')->with('success', 'Filière supprimée avec succès.');
    }
}
