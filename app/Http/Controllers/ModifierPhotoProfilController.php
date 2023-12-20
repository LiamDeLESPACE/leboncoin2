<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Compteutilisateur;
use App\Models\Profil;
use App\Models\Particulier;
use App\Models\Entreprise;
use App\Models\Photo;
use App\Models\Ville;
use App\Models\Adresse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Annonce;
use App\Models\TypeLogement;
use App\Models\Proprietairee;
use App\Models\CapaciteVoyageur;
use Illuminate\Support\Carbon;
use App\Providers\RouteServiceProvider;

class ModifierPhotoProfilController extends Controller
{
    public function modifierPhoto(Request $request)
    {
        // Validation du fichier
        $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $profil = getProfilConnecte($user);

        if (!$profil) {
            return Redirect::back()->with('error', 'Profil non trouvé.');
        }

        $photo = Photo::find($profil->idphoto);

        // Supprime la photo existante
        if ($photo) {
            Storage::delete("assets/images_profils/{$photo->donneesphoto}");
        }

        $photoNew = $request->file('photo');
        // Enregistre la nouvelle photo
        $photoPath = time().rand(0,999999).'.'.$photoNew->extension();
        $photoNew->move(public_path('assets/images_profils'), $photoPath);

        // Crée une nouvelle instance de Photo si elle n'existe pas
        if (!$photo) {
            $photo = new Photo();
            $photo->idphoto = getMaxIdPhoto() + 1;
            $photo->idutilisateur = $user->idutilisateur;
        }

        // Met à jour le chemin du fichier de la photo
        $photo->donneesphoto = $photoPath;
        $photo->save();

        return Redirect::back()->with('success', 'Photo mise à jour avec succès.');
    }

}

function getProfilConnecte(User $user)
{
    return Profil::where('idutilisateur', $user->idutilisateur)->first();
}

function getMaxIdPhoto()
{
    return DB::table('photo')->max('idphoto');
}