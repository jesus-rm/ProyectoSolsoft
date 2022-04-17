<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estado;
use App\Models\User;

class Municipio extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'claveMunicipio',
        'nombreMunicipio',
        'estado_id'
    ];

    //Relacion Uno a Muchos (One to Many) Inversa
    public function estados(){
        return $this->belongsTo(Estado::class,'estado_id');
    }

    // Relacion Uno a Muchos (One to Many)
    public function users(){
        return $this->hasMany('App\Models\User','id');
    }
}
