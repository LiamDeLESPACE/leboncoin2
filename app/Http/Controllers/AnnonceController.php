<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use App\Models\Annonce;
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

    /*public function showAnnonces($id) {
        
        $annonces = DB::table('annonce')
            ->join('adresse', 'annonce.idadresse', '=', 'adresse.idadresse')
            ->where('adresse.codeinsee', '=', '{{ $id }}')
            ->select('annonce.*', 'adresse.*')
            ->get();
        
            return view('annonces', [
                "annonces" => $annonces
            ]);
    }*/

    public function getAnnonces()
    {
        $annonces = Annonce::all();
        $villes = Ville::all();

        return view('annonces', [
            "annonces" => $annonces],
            ["villes" => $villes]
        );
    }
}