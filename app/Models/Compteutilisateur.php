<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Compteutilisateur extends Authenticatable
{
    use HasFactory;
    protected $table = "compteutilisateur";
    protected $primaryKey = "idc_u";
    public $timestamps = false;

    public function getAuthPassword(){
    return $this->a_password;
}
}
