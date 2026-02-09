<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidat;
use App\Models\Scrutin;

class DashbordAdminController extends Controller
{
    public function dashboardInterface(){
        $scrutins = Scrutin::with('filiere')->get(); // récupère les scrutins avec filières
        $candidats = Candidat::with('filiere','scrutin')->get(); // récupère les candidats avec filières et scrutins
        
       return view('admin.dashboardAdmin', compact('scrutins', 'candidats'));

    }
}
