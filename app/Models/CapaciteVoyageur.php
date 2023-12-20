<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaciteVoyageur extends Model
{
    use HasFactory;

    protected $table = "capacitevoyageur";
    protected $primaryKey = "idcapacitevoyageur";
    protected $fillable = ['idcapacitevoyageur', 'nbadultes', 'nbenfants', 'nbbebes', 'nbanimaux'];
    public $timestamps = false;


    public function getAnnonces()
    {
        return $this->belongsTo(Annonce::class, 'idcapacitevoyageur', 'idcapacitevoyageur');
    }
}
