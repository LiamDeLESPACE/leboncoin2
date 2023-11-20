<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    public function getVilles()
    {
        $villes = Ville::all();

        return view('villes', [
            "villes" => $villes
        ]);
    }
}
