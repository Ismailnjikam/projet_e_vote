<?php

namespace App\Http\Controllers;
use App\Models\Candidat;
use App\Models\Scrutin;
use App\Models\Filiere;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class CandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $candidats = Candidat::with(['filiere', 'scrutin'])->get();
        return view('candidats.index', compact('candidats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          $filieres = Filiere::all();
        $scrutins = Scrutin::all();
        return view('candidats.create', compact('filieres', 'scrutins'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'filiere_id' => 'required|exists:filieres,id',
            'scrutin_id' => 'required|exists:scrutins,id',
        ]);

        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('candidats', 'public');
        }

        Candidat::create($data);
        return redirect()->route('candidats.index')->with('success', 'Candidat ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidat $candidat)
    {
          $filieres = Filiere::all();
        $scrutins = Scrutin::all();
        return view('candidats.edit', compact('candidat', 'filieres', 'scrutins'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidat $candidat)
    {
         $request->validate([
            'nom' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'filiere_id' => 'required|exists:filieres,id',
            'scrutin_id' => 'required|exists:scrutins,id',
        ]);

        $data = $request->all();
        if ($request->hasFile('photo')) {
            if ($candidat->photo) {
                Storage::disk('public')->delete($candidat->photo);
            }
            $data['photo'] = $request->file('photo')->store('candidats', 'public');
        }

        $candidat->update($data);
        return redirect()->route('candidats.index')->with('success', 'Candidat mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidat $candidat)
    {
          if ($candidat->photo) {
            Storage::disk('public')->delete($candidat->photo);
        }
        $candidat->delete();
        return redirect()->route('candidats.index')->with('success', 'Candidat supprimé.');
    }
}
