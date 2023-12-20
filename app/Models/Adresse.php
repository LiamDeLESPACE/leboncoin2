<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Adresse extends Model
{
    use HasFactory;
    protected $table = "adresse";
    protected $primaryKey = 'idadresse';
    protected $fillable = ['idadresse', 'codeinsee', 'adresserue', 'adressenum', 'paysadresse'];
    public $timestamps = false;


    public function getAnnonces() {
        return $this->HasOne(Annonce::class, 'idadresse', 'idadresse');
    }
}
