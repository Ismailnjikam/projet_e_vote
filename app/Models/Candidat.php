<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    protected $fillable = ['nom', 'scrutin_id','photo', 'filiere_id', 'thematique'];

    public function filiere() {
        return $this->belongsTo(Filiere::class);
    }

    public function scrutin() {
        return $this->belongsTo(Scrutin::class);
    }

    public function votes() {
        return $this->hasMany(Vote::class);
    }
}


