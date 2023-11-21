<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

 class Ville extends Model
 {
     use HasFactory;
     protected $table = "ville";
     protected $primaryKey = "codeinsee";
     public $timestamps = false;

    public function adresses() {
        return $this->hasMany(Adresse::class, 'codeinsee', 'codeinsee');
    }
 }

