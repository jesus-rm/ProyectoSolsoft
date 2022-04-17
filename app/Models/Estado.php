<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Municipio;

class Estado extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'claveEstado',
        'nombreEstado',
        'codigoEstado'
    ];

    // Relacion Uno a Muchos (One to Many)
    public function municipios(){
        return $this->hasMany('App\Models\Municipio','id');
    }

    // Relacion Uno a Muchos (One to Many)
    public function users(){
        return $this->hasMany('App\Models\User','id');
    }
}
