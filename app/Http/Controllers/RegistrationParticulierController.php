<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Compteutilisateur;
use App\Models\Profil;
use App\Models\Particulier;
use App\Models\Entreprise;
use App\Models\Photo;
use App\Models\Ville;
use App\Models\Adresse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationParticulierController extends Controller
{
    //----------------------Affiche la page pour créer un compte
    function registrationParticulier(){
        return view ('registrationParticulier');
    }


    //------------------------------------------Création de compte
    function registrationParticulierPost(Request $request){
        
        $credentials = $request->validate([
            'pseudo' => ['required'],
            'mailparticulier' => ['required', 'regex:/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/i'],
            'passwd' => ['required', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W+)[A-Za-z\d\W+]{12,}$/i'],
            'telprofil' => ['required', 'regex:/(06|07)[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}|(06|07) [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}/i'],
        ]);

        unset($credentials["passwd"]);
        $credentials["password"] = $request->passwd;

        $maxIdc_u = getMaxIdc_u();
        $maxIdutilisateur = getMaxIdutilisateur();
        $maxIdadresse = getMaxIdAdresse();
        ++$maxIdc_u;
        ++$maxIdutilisateur;
        ++$maxIdadresse;

        // Récupère la valeur du formulaire
        $input['mailparticulier'] = $request->get('mailparticulier');

        // Ne doit pas déjà exister dans la colonne `mailparticulier` de la table `compteutilisateur`
        $rules = array('mailparticulier' => 'unique:compteutilisateur,mailparticulier');

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return back()->with("error", "Connexion impossible. L'adresse mail existe déjà. Êtes-vous sûr de ne pas avoir un compte ?");
        }
        else {

            
            $pseudo = $request->get('pseudo');
            $mailparticulier = $request->get('mailparticulier');
            $telparticulier = $request->get('telprofil');
           
            $password = Hash::make($request->get('passwd'));
            
            

            //Insert dans Compteutilisateur
            $user = DB::table('compteutilisateur')->insert([
                'idc_u' => $maxIdc_u,
                'idutilisateur' => $maxIdutilisateur,
                'pseudoprofil' => $pseudo,
                'mailparticulier' => $mailparticulier,
                'motdepasseprofil' => $password,
                'telprofil' => $telparticulier,
                'telverifier' => 'FALSE',
                'codeetatcu' => '1',
                'siret' => null
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

            //Insert dans Particulier
            $user = DB::table('particulier')->insert([
                'idutilisateur' => $maxIdutilisateur,
                'idproprietaire' => null,
                'idlocataire' => null,
                'nomparticulier' => null,
                'prenomparticulier' => null,
                'datenaissanceparticulier' => null,
                'sexeparticulier' => null,
            ]);

        }
        
        if(!$user){
            return redirect(route('registrationParticulier'))->with("error", "L'inscription n'a pas marché, essayez à nouveau.");
        }
        return redirect(route('loginParticulier'))->with("success", "Inscription réussie, connectez-vous pour accéder au site.");

        
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