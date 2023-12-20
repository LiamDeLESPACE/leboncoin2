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

class AffichageCompteController extends Controller
{
    //-------------------Affiche le compte de la personne connectée
    function showCount(){
         
        $utilisateur = getUtilisateurConnecte();
        $profil = getProfilConnecte();       
        $photo = Photo::findOrFail($profil->idphoto);
        $adresseProfil = getAdresseProfilConnecte();
        $entreprise = getEntrepriseConnecte();
        $villes = Ville::all();

        return view('monCompte')
        ->with(["utilisateur"=>$utilisateur])
        ->with(['photo'=>$photo])
        ->with(["adresseProfil"=>$adresseProfil])
        ->with(['villes'=>$villes])
        ->with(["entreprise"=>$entreprise])
        ->with(["profil"=>$profil]);
            
    }
}

function getUtilisateurConnecte(){
    return DB::table('compteutilisateur')
    ->where('idutilisateur', '=', Auth::user()->idutilisateur )
    ->first();
}

function getProfilConnecte(){
    return DB::table('profil')
    ->where('idutilisateur', '=', Auth::user()->idutilisateur )
    ->first();
}

function getAdresseProfilConnecte(){
    return DB::table('adresse')
    ->where('idadresse', '=', Auth::user()->idadresse )
    ->first();
}

function getEntrepriseConnecte(){
    return DB::table('entreprise')
    ->where('idutilisateur', '=', Auth::user()->idutilisateur )
    ->first();
}