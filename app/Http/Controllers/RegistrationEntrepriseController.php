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

class RegistrationEntrepriseController extends Controller
{

    //----------------------Affiche la page pour créer un compte
    function registrationEntreprise(){
        $villes = Ville::all();

       return view ('registrationEntreprise')
       ->with(['villes'=>$villes]);
    }


    //------------------------------------------Création de compte
    function registrationEntreprisePost(Request $request){
        
        $credentials = $request->validate([
            'nomSociete' => ['required'],
            'siret' => ['required', 'regex:/[0-9]{14}/i'],
            'secteurActivite' => ['required'],
            'passwd' => ['required', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W+)[A-Za-z\d\W+]{12,}$/i'],
        ]);

        unset($credentials["passwd"]);
        $credentials["password"] = $request->passwd;

        $maxIdc_u = getMaxIdc_u();
        $maxIdutilisateur = getMaxIdutilisateur();
        $maxIdadresse = getMaxIdAdresse();
        $maxIdproprietaire = getMaxIdproprietaire();
        ++$maxIdc_u;
        ++$maxIdutilisateur;
        ++$maxIdadresse;
        ++$maxIdproprietaire;

        // Récupère la valeur du formulaire
        $input['siret'] = $request->get('siret');

        // Ne doit pas déjà exister dans la colonne `siret` de la table `compteutilisateur`
        $rules = array('siret' => 'unique:compteutilisateur,siret');

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->with("error", "Connexion impossible. Le siret existe déjà. Êtes-vous sûr de ne pas avoir un compte ?");
        }
        else {

            $nomSociete = $request->get('nomSociete');
            $siret = $request->get('siret');
            $secteurActivite = $request->get('secteurActivite');
            $password = Hash::make($request->get('passwd'));

            //Insert dans Compteutilisateur
            $user = DB::table('compteutilisateur')->insert([
                'idc_u' => $maxIdc_u,
                'idutilisateur' => $maxIdutilisateur,
                'pseudoprofil' => null,
                'mailparticulier' => null,
                'motdepasseprofil' => $password,
                'telprofil' => null,
                'telverifier' => 'FALSE',
                'codeetatcu' => '2',
                'siret' => $siret
            ]);
            
            //Insert dans Adresse
            $user = DB::table('adresse')->insert([
                'idadresse' => $maxIdadresse,
                'codeinsee' => null,
                'adresserue' => null,
                'adressenum' => null,
                'paysadresse' => 'France',
            ]);

            //Insert dans Profil
            $user = DB::table('profil')->insert([
                'idutilisateur' => $maxIdutilisateur,
                'idc_u' => $maxIdc_u,
                'idphoto' => 211,
                'idadresse' => $maxIdadresse,
                'tempsreponse' => null,
                'datemembre' => date(now()),
                'recommandationprofil' => 'FALSE',
            ]);

            //Insert dans Entreprise
            $user = DB::table('entreprise')->insert([
                'idutilisateur' => $maxIdutilisateur,
                'idproprietaire' => $maxIdproprietaire,
                'nomsociete' => $nomSociete,
                'secteuractivite' => $secteurActivite,
                'remember_token' => null,
            ]);

        }
        
        if(!$user){
            return redirect(route('registrationEntreprise'))->with("error", "L'inscription n'a pas marché, essayez à nouveau.");
        }
        return redirect(route('loginEntreprise'))->with("success", "Inscription réussie, connectez-vous pour accéder au site.");

        
    }


} 
function getMaxIdc_u(){
    return DB::table('compteutilisateur')->max('idc_u');
}

function getMaxIdutilisateur(){
    return DB::table('compteutilisateur')->max('idutilisateur');
}

function getMaxIdAdresse(){
    return DB::table('adresse')->max('idadresse');
}

function getMaxIdproprietaire(){
    return DB::table('entreprise')->max('idproprietaire');
}