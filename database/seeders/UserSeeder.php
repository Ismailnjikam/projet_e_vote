<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Filiere;
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
        User::factory()->create([
            'name' => 'sima',
            'email' =>'sima@gmail.com',
            'login' => 'CM123',
            'role'=>'admin',
            'filiere_id'=>null,
            'password'=>Hash::make('password123'),
        ]);

        //creer 10 votant de facon aleatoire
        User::factory(10)->votant()->create();

        $filiere =  Filiere::first();
        if($filiere){
            User::factory(5)->votant()->create([
                'filiere_id' => $filiere->id,
            ]);
        }

    }
}
