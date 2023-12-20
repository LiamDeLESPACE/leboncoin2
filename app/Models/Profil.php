<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Profil extends Model
{
    use HasFactory;
    protected $table = "profil";
    protected $primaryKey = "idutilisateur";
    public $timestamps = false;

    public function adresse() {
        return $this->HasOne(Adresse::class, 'idadresse', 'idadresse');
    }

    public function photo() {
        return $this->HasOne(Photo::class, 'idphoto', 'idphoto');
    }
    
    public function user() {
        return $this->HasOne(User::class, 'idc_u', 'idc_u');
    }
}
