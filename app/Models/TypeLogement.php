<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeLogement extends Model
{
    use HasFactory;
    protected $table = "typelogement";
    protected $primaryKey = "idtypelogement";
    public $timestamps = false;
}
