<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use Notifiable;

    protected $table = 'utilisateurs'; // Important : Laravel utilisera cette table

    protected $fillable = [
        'name', // ou 'nom' selon ta colonne
        'login',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}


