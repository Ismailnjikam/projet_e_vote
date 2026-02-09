<?php

namespace App\Http\Controllers;

use App\Models\Scrutin;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome(){
        $scrutins = Scrutin::with('filiere')->get();
        return view('welcome', compact('scrutins'));
    }
}
