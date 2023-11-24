<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Ville;
use App\Models\Annonce;
use App\Models\Addresse;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    // public function showAnnonces()
    // {
    //     $annonce = Annonce::table('annonce')
    //     ->leftJoin('adresse', 'annonce.idadresse', '=', 'addresse.idadresse')
    //         ->where('adresse.codeinsee', '=', '{{ $id }}')
    //         ->get();
    //     return view("annonces",[
    //         "annonce"=>$annonce]);
    // }

    /*public function showAnnonces($codeinsee = 01001) {
        $annonces = Annonce::whereHas('adresse', function ($query) use ($codeinsee) {
                $query->where('codeinsee', $codeinsee);
            })
            ->get();

        return view("annonces", [
            "annonces" => $annonces
        ]);
    }*/

    public function showAnnonces(Request $request) {
        $codeinsee = $request->get('codeinsee');
        $ville=Ville::findOrFail($codeinsee);
        $adresses=Ville::findOrFail($codeinsee)->getAdresses;
        $annonces = collect();
        $users = collect(['grozob']);
        $users->append('team');
        foreach($adresses as $adresse)
        {
            $annonces->append($adresse->getAnnonces);
        }
        /*$annonces = DB::table('annonce')
            ->join('adresse', 'annonce.idadresse', '=', 'adresse.idadresse')
            ->where('adresse.codeinsee', '=', 'codeinsee')
            ->select('annonce.*', 'adresse.*')
            ->get();*/
        return view('annonces', [
            "annonces" => $annonces], ["ville" => $ville]
        );
    }

    public function getAnnonces()
    {
        $villes = Ville::all();

        return view('annonces', ["villes" => $villes]
        );
    }
}