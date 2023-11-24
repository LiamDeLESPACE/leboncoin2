<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Adresse extends Model
{
    use HasFactory;
    protected $table = "adresse";
    protected $primaryKey = 'idadresse';
    protected $timestamp = false;

    public function getAnnonces() {
        return $this->hasMany(Annonce::class, 'idadresse', 'idadresse');
    }
}
