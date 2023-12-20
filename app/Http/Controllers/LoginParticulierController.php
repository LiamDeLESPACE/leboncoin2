<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Compteutilisateur;
use App\Models\Profil;
use App\Models\Particulier;
use App\Models\Entreprise;
use App\Models\Photo;
use App\Models\Ville;
use App\Models\Adresse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginParticulierController extends Controller
{
    //---------------Affiche la page pour se connecter en tant que particulier
    function loginParticulier(){
        return view ('loginParticulier');
    }

    //-----------------------------------Connexion de compte particulier
    function loginParticulierPost(Request $request){
        $credentials = $request->validate([
            'mailparticulier' => ["required", "email"],            
            'password' => ["required"],
        ]);

        
        if(Auth::attempt($credentials)){ 
            return redirect('/');           
        }

        return back()->with("error", "Connexion impossible. Mauvaise adresse mail ou mauvais mot de passe.");
        
    }

} 