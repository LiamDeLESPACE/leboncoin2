<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    public function showAnnonces()
    {
        $annonce = Annonce::table('annonce')
        ->leftJoin('adresse', 'annonce.idadresse', '=', 'addresse.idadresse')
            ->where('adresse.codeinsee', '=', '{{ $id }}')
            ->get();
        return view("annonces",[
            "annonce"=>$annonce]);
    }
}
