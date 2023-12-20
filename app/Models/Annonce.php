<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Annonce extends Model
{
    use HasFactory;
    protected $table = "annonce";
    protected $primaryKey = "idannonce";
    public $timestamps = false;

    public function capaciteVoyageur()
    {
        return $this->belongsTo(CapaciteVoyageur::class, 'idcapacitevoyageur', 'idcapacitevoyageur');
    }

    public function proprietaire(){
        return $this->belongsTo(Proprietairee::class, 'idproprietaire', 'idproprietaire');
    }

    public function typeLogement(){
        return $this->belongsTo(TypeLogement::class, 'idtypelogement', 'idtypelogement');
    }

    public function adresse()
    {
        return $this->belongsTo(Adresse::class, 'idadresse', 'idadresse');
    }
    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'annonce_photos', 'idannonce', 'idphoto');
    }
}

