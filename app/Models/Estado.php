<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $fillable = [
        'claveEstado',
        'nombreEstado',
        'codigoEstado'
    ];

    // Relacion Uno a Muchos (One to Many)
    public function municipios(){
        return $this.hasMany('App\Models\Municipio');
    }

    // Relacion Uno a Muchos (One to Many)
    public function users(){
        return $this.hasMany('App\Models\User');
    }
}
