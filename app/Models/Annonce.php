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

    public function adresse() {
        return $this->belongsTo(Adresse::class, 'idadresse', 'idadresse');
    }
}
