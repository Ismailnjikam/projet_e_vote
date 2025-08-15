<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scrutin;
use App\Models\Filiere;

class ScrutinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $scrutins = Scrutin::with('filiere')->get();
        return view('scrutins.index', compact('scrutins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filieres = Filiere::all();
        return view('scrutins.create', compact('filieres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'nom' => 'required|string|max:255',
            'filiere_id' => 'required|exists:filieres,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
              ]);
                Scrutin::create($request->all());

        return redirect()->route('scrutins.index')->with('success', 'Scrutin créé avec succès.');
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
    public function edit(Scrutin $scrutin)
    {
          $filieres = Filiere::all();
        return view('scrutins.edit', compact('scrutin', 'filieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Scrutin $scrutin)
    {
         $request->validate([
            'nom' => 'required|string|max:255',
            'filiere_id' => 'required|exists:filieres,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $scrutin->update($request->all());

        return redirect()->route('scrutins.index')->with('success', 'Scrutin mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scrutin $scrutin)
    {
         $scrutin->delete();
        return redirect()->route('scrutins.index')->with('success', 'Scrutin supprimé avec succès.');
    }
    }

