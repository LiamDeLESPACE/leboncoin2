<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RechercheController extends Controller
{
    public function registrationPost(Request $request) {
        
        $datedebut = $request->get('datedebut');
        $dated = date('Y/m/d', strtotime($datedebut));
        $idinternaute = $request->get('_token');
        $codeinsee = $request->get('codeinsee');
        $nbadulte = (int)$request->get('adulte');
        $nbenfant = (int)$request->get('enfant');
        $nbbebe = (int)$request->get('bebes');
        $nbanimaux = (int)$request->get('animaux');
        $critereliste = $request->input('categorie', []);
        $MaxIdCapaciteVoyageur = getMaxIdCapaciteVoyageur();
        $MaxIdCapaciteVoyageur++;
        $MaxIdRecherche = getMaxIdRecherche();
        $MaxIdRecherche++;
        
        $capacitevoyageur = DB::table('capacitevoyageur')->insert([
            'idcapacitevoyageur' => $MaxIdCapaciteVoyageur,
            'nbadultes' => $nbadulte,
            'nbenfants' => $nbenfant,
            'nbbebes' => $nbbebe,
            'nbanimaux' => $nbanimaux
        ]);
        $recherche = DB::table('recherche')->insert([
            'idrecherche' => $MaxIdRecherche,
            'idcapacitevoyageur' => $MaxIdCapaciteVoyageur,
            'codeinsee' => $codeinsee,
            'idinternaute' => $idinternaute,
            'datedebut' => $dated
        ]);
        foreach($critereliste as $critere)
        {
            
            $c = DB::table('cherchecritere')->insert([
                'idcritere' => $critere,
                'idrecherche' => $MaxIdRecherche

            ]);
        }
        return redirect('/');
    }
}
function getMaxIdCapaciteVoyageur(){
    return DB::table('capacitevoyageur')->max('idcapacitevoyageur');
}
function getMaxIdRecherche(){
    return DB::table('recherche')->max('idrecherche');
}
