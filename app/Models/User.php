<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "compteutilisateur";
    public $timestamps = false;
    protected $primaryKey = "idc_u";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [

        'idc_u',
        'idutilisateur',
        'pseudoprofil',
        'mailparticulier',
        'motdepasseprofil',
        'telprofil',
        'telverifier',
        'ceodeetatcu',
        'siret',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'motdepasseprofil',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getAuthPassword() {
        return $this->motdepasseprofil;
    }

    // public function idc_u(): HasOne
    // {
    //     return $this->hasOne(Idc_u::class);
    // }
}
