<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // Affiche le formulaire d'inscription
    public function showRegister()
    {
        return view('auth.register');
    }

    // Enregistre un nouvel utilisateur
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,login',
            'password' => 'required|string|min:8|confirmed',
        ]);

        //permet de generer le login d'acces a la plateforme
        $nextNumber = User::where('role','votant')->count()+1;
        $login = 'votant' . str_pad($nextNumber, 4 , STR_PAD_LEFT);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'login'=>$login,
            'password' => Hash::make($request->password),
        ]);

        Mail::send('email.login-notification',[
            'user'=>$user,
            'login'=>$login,
        ],function($message)use($user){
            $message->to($user->email)->subject('Vos identifiants de connexion - Plateforme de vote');
        });

        return redirect()->route('login')->with('message','Inscription réussie! Vérifiez votre email pour vos identifiants de conncxion .');
    }

    // Affiche le formulaire de connexion
    public function showLogin()
    {
        return view('auth.login');
    }

    // Connecte un utilisateur
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['login', 'password']);

        $user = User::where('login', $request->login)->first();
        if(!$user){
            return redirect()->route('register')->with('message',' Compte votant introuvalble ! veuillez vous inscrire');
        }

        if(!Hash::check($request->password, $user->password)){
            return back()->withErrors([
                'password'=>'mot de passe incorrect! veuillez saisir a nouveau'
            ])->withInput($request->except('password'));
        }
        
            Auth::login($user);
        if($user->role === 'admin'){
            return redirect()->route('admin.dashboard')->with('message','connexion reussi');
        }else{

            return redirect()->intended(route('votant.dashboard'))->with('message','connexion reussi');
        }
        
    }

    // Déconnecte l'utilisateur
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('Deconnexion reussi');
    }
}
