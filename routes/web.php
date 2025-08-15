<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\ScrutinController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\VoteController;
use App\Models\Scrutin;

Route::get('/', function () {
    $scrutins = Scrutin::with('filiere')->get();
    return view('welcome', compact('scrutins'));
});



Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
// Afficher le formulaire d'inscription (GET)
Route::get('/register', function () {
    return view('auth.register'); // Ton fichier Blade
})->name('register');

// Traitement du formulaire d'inscription (POST)
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
//


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

//Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
//Route::post('/login', [AuthController::class, 'login']);
//Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Exemple de route protégée
//Route::get('/dashboard', function () {
  //  return view('dashboard');})->name('dashboard');
  
use App\Models\Candidat;

Route::get('/dashboard', function () {
    $scrutins = Scrutin::with('filiere')->get(); // récupère les scrutins avec filières
    $candidats = Candidat::with('filiere','scrutin')->get(); // récupère les candidats avec filières et scrutins

    return view('dashboard', compact('scrutins', 'candidats'));
})->middleware('auth')->name('dashboard');

Route::resource('filieres', FiliereController::class);
Route::resource('scrutins', ScrutinController::class);
Route::resource('candidats', CandidatController::class);
//Route::get('/votes/create/{scrutin}', [VoteController::class, 'create'])->name('votes.create')->middleware('auth');
//Route::post('/votes', [VoteController::class, 'store'])->name('votes.store')->middleware('auth');
Route::middleware(['auth'])->group(function() {
    Route::get('/votes/{scrutin}', [VoteController::class, 'create'])->name('votes.create');
    Route::post('/votes', [VoteController::class, 'store'])->name('votes.store');
});

