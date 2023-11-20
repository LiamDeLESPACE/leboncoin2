<?php

namespace App\Http\Controllers;

use App\Models\TypeLogement;
use Illuminate\Http\Request;

class TypeLogementController extends Controller
{
    public function getTypesLogement()
    {
        $typeslogement = TypeLogement::all();

        return view('annonces', [
            "typeslogement" => $typeslogement
        ]);
    }
}
