<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Entreprise extends Model
{
    use HasFactory;
    protected $table = "entreprise";
    protected $primaryKey = "idutilisateur";
    public $timestamps = false;
    
    public function profil() 
    {
        return $this->HasOne(Profil::class, 'idutilisateur', 'idutilisateur');
    }
}

class EntrepriseBis extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'siret', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $primaryKey = 'siret';

    public $incrementing = false;
    public function getAuthIdentifierName()
    {
        return 'siret';
    }
}

