<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model

{
    protected $fillable = ['user_id', 'candidat_id', 'scrutin_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function candidat() {
        return $this->belongsTo(Candidat::class);
    }

    public function scrutin() {
        return $this->belongsTo(Scrutin::class);
    }
}


