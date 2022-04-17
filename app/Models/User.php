<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Estado;
use App\Models\Municipio;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';

    protected $fillable = [
        'id',
        'nombre',
        'apellidoPaterno',
        'apellidoMaterno',
        'fechaNacimiento',
        'rfc',
        'curp',
        'telefono',
        'celular',
        'email',
        'edad',
        'password',
        'estado_id',
        'municipio_id',
        'avatar',
        'dateLogin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relacion Uno a Muchos (One to Many) Inversa
    public function estados(){
        return $this->belongsTo(Estado::class,'estado_id');
    }

    //Relacion Uno a Muchos (One to Many) Inversa
    public function municipios(){
        return $this->belongsTo(Municipio::class,'municipio_id');
    }
}
