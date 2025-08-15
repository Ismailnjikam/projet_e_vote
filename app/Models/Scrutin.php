<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scrutin extends Model
{
  




    protected $fillable = ['nom', 'filiere_id', 'date_debut', 'date_fin'];

    public function filiere() {
        return $this->belongsTo(Filiere::class);
    }

    public function candidats() {
        return $this->hasMany(Candidat::class);
    }

    public function votes() {
        return $this->hasMany(Vote::class);
    }
}


