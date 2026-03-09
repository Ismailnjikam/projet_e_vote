<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Filiere;
use App\Models\Utilisateur;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Utilisateur::factory()->create([
            'name' => 'sima',
            'email' =>'sima@gmail.com',
            'login' => 'CM123',
            'role'=>'admin',
            'filiere_id'=>null,
            'password'=>Hash::make('password123'),
        ]);

        Utilisateur::factory()->create([
            'name' => 'sampa',
            'email' =>'sampa@gmail.com',
            'login' => 'CM124',
            'role'=>'admin',
            'filiere_id'=>null,
            'password'=>Hash::make('password1234'),
        ]);

        //creer 10 votant de facon aleatoire
        Utilisateur::factory(10)->votant()->create();

        $filiere =  Filiere::first();
        if($filiere){
            Utilisateur::factory(5)->votant()->create([
                'filiere_id' => $filiere->id,
            ]);
        }

    }
}
