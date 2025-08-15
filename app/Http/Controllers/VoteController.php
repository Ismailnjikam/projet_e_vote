<?php

namespace App\Http\Controllers;
use App\Models\Scrutin;
use App\Models\Candidat;
use App\Models\Vote;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($scrutin_id)
    {
          $scrutin = Scrutin::with('candidats')->findOrFail($scrutin_id);

        // Vérifier si l'utilisateur a déjà voté pour ce scrutin
        $user = Auth::user();
        $alreadyVoted = Vote::where('user_id', $user->id)
                            ->where('scrutin_id', $scrutin->id)
                            ->exists();

        if ($alreadyVoted) {
            return redirect()->route('dashboard')->with('error', 'Vous avez déjà voté pour ce scrutin.');
        }

        return view('votes.create', compact('scrutin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'candidat_id' => 'required|exists:candidats,id',
            'scrutin_id' => 'required|exists:scrutins,id',
        ]);

        $user = Auth::user();

        // Vérifier à nouveau si l'utilisateur a déjà voté
        $alreadyVoted = Vote::where('user_id', $user->id)
                            ->where('scrutin_id', $request->scrutin_id)
                            ->exists();

        if ($alreadyVoted) {
            return redirect()->route('dashboard')->with('error', 'Vous avez déjà voté pour ce scrutin.');
        }

        // Créer le vote
        Vote::create([
            'user_id' => $user->id,
            'candidat_id' => $request->candidat_id,
            'scrutin_id' => $request->scrutin_id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Votre vote a été enregistré avec succès.');
    }

    }
       

    /**
     * Display the specified resource.
     */
    //public function show(string $id)
    //{
        //
    //}

    /**
     * Show the form for editing the specified resource.
     */
    /*public function edit(string $id)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     */
   /* public function update(Request $request, string $id)
    {
        //
    }*/
   
    /**
     * Remove the specified resource from storage.
     */
    /*public function destroy(string $id)
    {
        //
    }
        */
       

