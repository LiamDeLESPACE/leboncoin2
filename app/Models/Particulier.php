<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Particulier extends Model
{
    use HasFactory;
    protected $table = "particulier";
    protected $primaryKey = "idutilisateur";
    public $timestamps = false;

    public function profil() 
    {
        return $this->HasOne(Profil::class, 'idutilisateur', 'idutilisateur');
    }
}

