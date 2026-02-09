<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\ScrutinController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\DashbordAdminController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\WelcomeController;
use App\Models\Scrutin;

Route::get('/welcome', [WelcomeController::class, 'welcome'])->name('welcome');



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



Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

  

Route::middleware(['auth','admin'])->group(function(){
Route::get('/admin/dashboard', [DashbordAdminController::class ,'dashboardInterface'])->name('admin.dashboard');
});
Route::resource('filieres', FiliereController::class);
Route::resource('scrutins', ScrutinController::class);
Route::resource('candidats', CandidatController::class)->middleware(['auth']);

Route::middleware(['auth'])->group(function() {
    Route::get('/votes/{scrutin}', [VoteController::class, 'create'])->name('votes.create');
    Route::post('/votes', [VoteController::class, 'store'])->name('votes.store');
});

// Routes d'acces pour le votant
Route::middleware(['auth','votant'])->group(function(){
Route::get('/dashbaord', function(){
    return view('votant.dashboardVotant');
})->name('votant.dashboard');
});
