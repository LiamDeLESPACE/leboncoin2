<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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

    public function showCreateTypeLogement()
    {
        $typeslogement = TypeLogement::all();
        $annonces = DB::table('annonce')
                        ->join("typelogement", "annonce.idtypelogement", "=", "typelogement.idtypelogement")
                        ->orderBy('idannonce')      
                        ->get();

        return view('create-typelogement')
        ->with(["annonces" => $annonces])
        ->with(["typeslogement" => $typeslogement]);
    }
    public function updateTypelogement(Request $request, $id)
    {
        $idtypelogement= $request->get('typelogement');
        //dd($idtypelogement);
        $affected = DB::table('annonce')
              ->where('idannonce', $id)
              ->update(['idtypelogement' => $idtypelogement]);
        
        return redirect("/");
    }

    public function registrationPost(Request $request)
    {

        if(preg_match('~[A-Z]{1}[a-z]+~', $request->get('libelletypelogement'))){

            $lbtypelogement = $request->get('libelletypelogement');
            $typelogement = DB::table('typelogement')->insert([
                'idtypelogement' => DB::raw("nextval('SEQ_TYPELOGEMENT')"),
                'libelletypelogement' => $lbtypelogement
            ]);
    
        }
        else{
            return back()->with("error", "Mauvais type de logement");
        }
        
        return redirect("/create-typelogement");


    }
}
