<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
   
     protected $fillable = ['name','email','login', 'password', 'filiere_id', 'role','promoted_by','promoted_at','revoqued_by','revoqued_at'];

    protected $hidden = ['password'];

    public function filiere() {
        return $this->belongsTo(Filiere::class);
    }

    public function votes() {
        return $this->belongsTo(Vote::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'login_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function makeAdmin($id){
        $user = Auth::user();

        if($user->role !== 'admin'){
            return false;
        }

        $targetUser = User::findOrFail($id);
        
        if($targetUser->role === 'admin'){
            return "Vous êtes déjà administrateur";
        }

        $targetUser->update([
            'role' => 'admin',
            'promoted_by'=>$user->id,
            'promoted_at'=>now(),
            ]);
        return "utilisateur {$targetUser->name} a ete nomme admin avec succes";
        
    }

    public function revokeAdmin($id){
        $user = Auth::user();

        if($user->role !== 'admin'){
            return false;
        }

        $targetUser = User::findOrFail($id);

        if($targetUser->role === 'votant'){
            return "cet utilisateur est deja votant";
        }

        if($targetUser->id === $user->promoted_by){
            return "Vous ne pouvez pas revoque celui qui vous a nomme administrateur";
        }

        if($targetUser->id === $user->id){
            return "Vous ne pouvez pas vous meme revoque vos droit admin";
        }

        $targetUser->update([
            'role'=>'votant',
            'revoqued_by'=>$user->id,
            'revoqued_at'=>now()
            ]);
        return "les droit admin de {$targetUser->name} ont ete revoque avec succes";

    }

}
