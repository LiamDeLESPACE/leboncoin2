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

class ModificationCompteController extends Controller
{
    //----------------------Affiche la page pour modifier un compte
    function modifierCompte(){

        $utilisateur = getUtilisateurConnecte();
        $profil = getProfilConnecte();
        $particulier = getParticulierConnecte();
        $adresseProfil = getAdresseProfilConnecte();
        $entreprise = getEntrepriseConnecte();
        $villes = Ville::all();

        $photo=Photo::find($profil->idphoto);

        return view ('modifierCompte')
        ->with(["utilisateur"=>$utilisateur])
        ->with(["profil"=>$profil])
        ->with(["particulier"=>$particulier])
        ->with(["adresseProfil"=>$adresseProfil])
        ->with(["entreprise"=>$entreprise])
        ->with(['villes'=>$villes])
        ->with(['photo'=>$photo]);
    }

    //-----------------------------------Modification de compte
    function modifierComptePost(Request $request){
        
        $newPassword = $request->get('passwd');
        if($newPassword == ''){
            $credentials = $request->validate([
                'email' => [ 'regex:/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/i'],
                'siret' => [ 'regex:/[0-9]{14}/i'],
                'telprofil' => [ 'regex:/(06|07)[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}|(06|07) [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}/i'],
            ]);
        }
        else{
            $credentials = $request->validate([
                'email' => [ 'regex:/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/i'],
                'siret' => [ 'regex:/[0-9]{14}/i'],          
                'passwd' => ['regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W+)[A-Za-z\d\W+]{12,}$/i'],
                'telprofil' => [ 'regex:/(06|07)[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}|(06|07) [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}/i'],
            ]);
        }
        
        if($newPassword != ""){
            $password = Hash::make($newPassword);
        }
        else{
            $utilisateur = getUtilisateurConnecte();
            $password = $utilisateur->motdepasseprofil;
        }
        //----------------------Update Particulier        
        DB::table('particulier')
            ->where('idutilisateur', '=', Auth::user()->idutilisateur )
            ->update([
                'nomparticulier' => $request->get('nomprofil'),
                'prenomparticulier' => $request->get('prenomprofil'),
                'sexeparticulier' => $request->get('sexe'),
                'datenaissanceparticulier' => $request->get('datenaissance')
        ]);
        
        //----------------------Update Entreprise        
        DB::table('entreprise')
            ->where('idutilisateur', '=', Auth::user()->idutilisateur )
            ->update([
                'nomsociete' => $request->get('nomSociete'),
                'secteuractivite' => $request->get('secteurActivite')
        ]);


        //----------------------Update Compteutilisateur
        DB::table('compteutilisateur')
        ->where('idutilisateur', '=', Auth::user()->idutilisateur )
        ->update([
            'mailparticulier' => $request->get('mailparticulier'),
            'pseudoprofil' => $request->get('pseudo'),
            'motdepasseprofil' => $password,
            'telprofil' => $request->get('telprofil'),
            'siret' => $request->get('siret')
        ]);

        //----------------------Update Profil
        // DB::table('profil')
        // ->where('idutilisateur', '=', Auth::user()->idutilisateur )
        // ->update([
            
        // ]);

        return redirect('/monCompte/modifierCompte')->with("success", "Modification enregistrée.");
        
    }

    //-----------------------------------Modification adresse de compte
    function modifierAdresseComptePost(Request $request){

        //----------------------Update Adresse
        DB::table('adresse')
        ->where('idadresse', '=', Auth::user()->idadresse )
        ->update([
            'adresserue' => $request->get('nomAdresse'),
            'adressenum' => $request->get('numAdresse')
            //'codeinsee' => $request->get('codeinsee')
        ]);

        return redirect('/monCompte/modifierCompte');
        
    }

    //--------------------------------Supprimer compte
    function supprimerCompte(Request $request){
        
        DB::table('particulier')
        ->where('idutilisateur', '=', Auth::user()->idutilisateur )->delete();

        DB::table('entreprise')
        ->where('idutilisateur', '=', Auth::user()->idutilisateur )->delete();

        DB::table('profil')
        ->where('idutilisateur', '=', Auth::user()->idutilisateur )->delete();

        DB::table('compteutilisateur')
        ->where('idutilisateur', '=', Auth::user()->idutilisateur )->delete();
        
        Auth::logout(); 
                     
        return redirect('/loginParticulier');
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

function getParticulierConnecte(){
    return DB::table('particulier')
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