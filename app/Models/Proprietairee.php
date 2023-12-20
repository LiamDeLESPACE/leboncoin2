<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proprietairee extends Model
{
    use HasFactory;

    protected $table = "proprietairee"; // Ensure it matches the actual table name
    protected $primaryKey = "idproprietaire";
    public $timestamps = false;

    public function getAnnonces() {
        return $this->HasMany(Annonce::class, 'idproprietaire', 'idproprietaire');
    }
}
