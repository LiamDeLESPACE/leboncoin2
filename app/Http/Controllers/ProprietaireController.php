<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Particulier;
use App\Models\Profil;
use App\Models\Photo;

class ProprietaireController extends Controller
{
    public function showProprietaire(Request $request, $id) {
        $proprietaire = Particulier::findOrFail($id);
        $profil = Profil::findOrFail($id);
        $photo = Photo::findOrFail($profil->idphoto);
        return view('profil')
        ->with(['proprietaire'=>$proprietaire])
        ->with(['profil'=>$profil])
        ->with(['photo'=>$photo]);

    }
}