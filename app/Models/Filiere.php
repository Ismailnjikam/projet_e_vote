<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    protected $fillable = ['nom'];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function scrutins() {
        return $this->hasMany(Scrutin::class);
    }

    public function candidats() {
        return $this->hasMany(Candidat::class);
    }
}


