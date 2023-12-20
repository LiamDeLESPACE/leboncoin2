<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Ville;
use App\Models\Annonce;
use App\Models\Adresse;
use App\Models\TypeLogement;
use App\Models\CapaciteVoyageur;
use App\Models\Photo;
use App\Models\Recherche;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    public function showAnnonces(Request $request) {
        $idinternaute = $request->get('_token');//identification de l'internaute
        $idrecherche = $request->get('recherche');//récupération de l'identification recherche
    //-----------Recherche-----------
        //récupération recherche
        $recherches = DB::table('recherche')
        ->join('ville', 'recherche.codeinsee', '=', 'ville.codeinsee')
        ->join('capacitevoyageur', 'recherche.idcapacitevoyageur', '=', 'capacitevoyageur.idcapacitevoyageur')
        ->where('idinternaute', '=', $idinternaute)->get();
        
        $recherche = Recherche::find($idrecherche);
        if($recherche!=null)//récupération des données de recherche
        {
            $capacitevoyageur = CapaciteVoyageur::find($recherche->idcapacitevoyageur);
            $codeinsee = $recherche->codeinsee;
            $datedebut = $recherche->datedebut;
            $dated = date('Y/m/d', strtotime($datedebut));
            $nbadulte = (int)$capacitevoyageur->nbadultes;
            $nbenfant = (int)$capacitevoyageur->nbenfants;
            $nbbebe = (int)$capacitevoyageur->nbbebes;
            $nbanimaux = (int)$capacitevoyageur->nbanimaux;
            $criterelistes = DB::table('cherchecritere')->where('cherchecritere.idrecherche', '=', $recherche->idrecherche)->get();
            $critereliste = array();
            foreach($criterelistes as $c)
            {
                array_push($critereliste,$c->idcritere);
            }
        }
        else //récupération des données des champs
        {
            $codeinsee = $request->get('codeinsee');
            $datedebut = $request->get('datedebut');
            $dated = date('Y/m/d', strtotime($datedebut));
            $nbadulte = (int)$request->get('adulte');
            $nbenfant = (int)$request->get('enfant');
            $nbbebe = (int)$request->get('bebes');
            $nbanimaux = (int)$request->get('animaux');
            $critereliste = $request->get('categorie', []);
        }
        $recherches = $recherches->unique('idrecherche');
        $ville=Ville::findOrFail($codeinsee);
        $typelogements=DB::table('typelogement')->get();
        $critere= DB::table('critere')->get();
        $categoriecritere = DB::table('categoriecritere')->get();
        $annonces = DB::table('annonce')
                ->join('adresse', 'annonce.idadresse', '=', 'adresse.idadresse')
                ->join('capacitevoyageur', 'annonce.idcapacitevoyageur', "=", "capacitevoyageur.idcapacitevoyageur")
                ->join('photo', 'annonce.idannonce', '=', 'photo.idannonce')
                ->join('typelogement', 'annonce.idtypelogement', "=", "typelogement.idtypelogement")
                ->join('datec', 'annonce.idannonce', '=', 'datec.idannonce')
                ->leftjoin('contient', 'annonce.idannonce', '=', 'contient.idannonce')
                ->where('adresse.codeinsee', $ville->codeinsee)
                ->where('capacitevoyageur.nbadultes', '>=', $nbadulte)
                ->where('capacitevoyageur.nbenfants', '>=', $nbenfant)
                ->where('capacitevoyageur.nbbebes', '>=', $nbbebe)
                ->where('capacitevoyageur.nbanimaux', '>=', $nbanimaux)
                ->whereNotNull('annonce.idannonce')
                /*->where('estactive', 'True')*/
                ->get();
        $annoncesfiltre = $annonces->where('datec', '>', $dated);
        if(sizeof($annoncesfiltre)!=0)
        {
            $annonces = $annoncesfiltre;
        }
        if($critereliste!=null)
        {
            $annonces = $annonces->whereIn('idcritere', $critereliste);
        }
        $annonces = $annonces->unique('idannonce');
        return view('annonces')
        ->with(["ville" => $ville])
        ->with(["annonces" => $annonces])
        ->with(["typelogements" => $typelogements])
        ->with(["datedebut" => $datedebut])
        ->with(["nbadulte" => $nbadulte])
        ->with(["nbenfant" => $nbenfant])
        ->with(["nbbebe" => $nbbebe])
        ->with(["nbanimaux" => $nbanimaux])
        ->with(["critere" => $critere])
        ->with(["categoriecritere" => $categoriecritere])
        ->with(["critereliste" => $critereliste])
        ->with(["recherches" => $recherches]);
    }

    public function showAnnonce(Request $request, $id) {
        $annonce = Annonce::findOrFail($id);
        $proprietaire = DB::table('particulier')
        ->where('idproprietaire', "=", $annonce->idproprietaire)
        ->get();
        $adresse = Adresse::findOrFail($annonce->idadresse);
        $ville = Ville::findOrFail($adresse->codeinsee);
        $annoncesimilaires = DB::table('annonce')
        ->rightJoin('adresse', 'annonce.idadresse', '=', 'adresse.idadresse')
        ->join('capacitevoyageur', 'annonce.idcapacitevoyageur', "=", "capacitevoyageur.idcapacitevoyageur")
        ->rightJoin('photo', 'annonce.idphoto', '=', 'photo.idphoto')
        ->rightjoin('typelogement', 'annonce.idtypelogement', "=", "typelogement.idtypelogement")
        //->join('datec', "datec.idannonce", "=", "annonce.idannonce")
        ->where('adresse.codeinsee', $ville->codeinsee)
        ->where("typelogement.idtypelogement", "=", $annonce->idtypelogement)
        ->get();

        //dd($annonce);
        $typelogement = TypeLogement::findOrFail($annonce->idtypelogement);
        $capacitevoyageur = CapaciteVoyageur::findOrFail($annonce->idcapacitevoyageur);
        $photos = DB::table('photo')
            ->where('idannonce', '=', $annonce->idannonce)
        ->get();
        return view('annonce')
        ->with(['annonce'=>$annonce])
        ->with(['photos'=>$photos])
        ->with(['typelogement'=>$typelogement])
        ->with(['ville'=>$ville])
        ->with(['capacitevoyageur'=>$capacitevoyageur])
        ->with(['proprietaire'=>$proprietaire])
        ->with(['annoncesimilaires'=>$annoncesimilaires]);
    }
}