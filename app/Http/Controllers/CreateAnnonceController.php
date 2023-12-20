<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\Adresse;
use App\Models\TypeLogement;
use App\Models\Ville;
use App\Models\Particulier;
use App\Models\Entreprise;
use App\Models\Photo;
use App\Models\Proprietairee;
use App\Models\CapaciteVoyageur;
use Illuminate\Support\Carbon;
use App\Providers\RouteServiceProvider;


class CreateAnnonceController extends Controller
{
    public function save(Request $request)
    {
        // Génération des IDs
        $idannonce = getMaxIdAnnonce() + 1;
        $idcapacitevoyageur = getMaxIdCapaciteVoyageur() + 1;
        $idadresse = getMaxIdAdresse() + 1;

        // Récupérer la capacité du voyageur
        $capaciteVoyageur = CapaciteVoyageur::create([
                'idcapacitevoyageur' => $idcapacitevoyageur,
                'nbadultes' => $request->input('adulte'),
                'nbenfants' => $request->input('enfant'),
                'nbbebes' => $request->input('bebes'),
                'nbanimaux' => $request->input('animaux'),
            ]);
        // Récupérer l'adresse
        $codeinsee = Ville::where('nomville', $request->input('codeinsee'))->value('codeinsee');
        $ville = Ville::where('nomville', $request->input('codeinsee'))->first();
        $adresse = Adresse::firstOrCreate([
                'idadresse' => $idadresse,
                'codeinsee' => $codeinsee,
                'adresserue' => $request->input('adresse'),
                'adressenum' => $request->input('numero'),
                'paysadresse' => 'France',
            ]);

        
        // Récupérer le propriétaire
        $utilisateur = Particulier::find(auth()->user()->idutilisateur);
        $idproprietaire = null;

        if ($utilisateur == null) {
            $utilisateur = Entreprise::find(auth()->user()->idutilisateur);
            if ($utilisateur != null) {
                $idproprietaire = $utilisateur->idproprietaire;
            } else {
                $proprietaire = new Proprietairee();
                $idproprietaire = getMaxIdProprietaire()+1;
                $proprietaire->idproprietaire = $idproprietaire;
                $proprietaire->save();
                $idproprietaire = $proprietaire->idproprietaire;
                $utilisateur->idproprietaire = $idproprietaire;
            }
        } else {
            if($utilisateur->idproprietaire == null){
                $proprietaire = new Proprietairee();
                $idproprietaire = getMaxIdProprietaire()+1;
                $proprietaire->idproprietaire = $idproprietaire;
                $proprietaire->save();
                $idproprietaire = $proprietaire->idproprietaire;
                $utilisateur->idproprietaire = $idproprietaire;
                $utilisateur->save();
            } else {
                $idproprietaire = $utilisateur->idproprietaire;
            }
        }

        // Enregistrement de l'annonce dans la base de données
        $annonce = new Annonce();
        $annonce->idannonce =$idannonce;
        $annonce->titreannonce = $request->input('titreannonce');
        $annonce->dureeminimumsejour = $request->input('dureeminimumsejour');
        $annonce->estactive = true;
        $annonce->datepublication = Carbon::now();
        $annonce->descriptionannonce = $request->input('descriptionannonce');
        $annonce->etoile = $request->input('etoile');
        $annonce->capaciteVoyageur()->associate($capaciteVoyageur);
        $annonce->adresse()->associate($adresse);
        $annonce->proprietaire()->associate($idproprietaire);
        $annonce->typeLogement()->associate($request->input('idtypelogement'));
        $annonce->save();
        
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                // dd($request);
                $idphoto = getMaxIdPhoto() + 1;
                $imageName = time().rand(0,999999).'.'.$photo->extension();
                $photo->move(public_path('assets/images_annonce'), $imageName);
                $imageAnnonce = Photo::create([
                    'idphoto' => $idphoto,
                    'idutilisateur' =>null,
                    'idannonce'=>$idannonce,
                    'donneesphoto'=>$imageName,
                ]);
                // dd($imageAnnonce);
                $annonce->idphoto= $imageAnnonce->idphoto;
            }    

        }

        $annonce->save();

        return redirect('/');
    }

    public function create()
    {
        $typesLogement = TypeLogement::all();
        $villes = Ville::all();

        $utilisateur = Particulier::find(auth()->user()->idutilisateur);
        $idproprietaire = null;

        if ($utilisateur == null) {
            $utilisateur = Entreprise::find(auth()->user()->idutilisateur);
            if ($utilisateur != null) {
                $idproprietaire = $utilisateur->idproprietaire;
            } else {
                $idproprietaire = "null";
            }
        } else {
            if($utilisateur->idproprietaire == null){
                $idproprietaire = "null";
            }else{
                $idproprietaire = $utilisateur->idproprietaire;
            }
        }
        // dd($typesLogement, $villes, $idproprietaire); // Vérifiez les valeurs avant de les passer à la vue

        return view('create-annonce', compact('typesLogement', 'villes', 'idproprietaire'));
    }    
}
function getMaxIdAnnonce(){
    return DB::table('annonce')->max('idannonce');
}
function getMaxIdCapaciteVoyageur(){
    return DB::table('capacitevoyageur')->max('idcapacitevoyageur');
}
function getMaxIdAdresse(){
    return DB::table('adresse')->max('idadresse');
}
function getMaxIdPhoto(){
    return DB::table('photo')->max('idphoto');
}
function getMaxIdProprietaire(){
    return DB::table('proprietairee')->max('idproprietaire');
}