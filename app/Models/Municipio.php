<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $fillable = [
        'claveMunicipio',
        'nombreMunicipio',
        'clave_estado'
    ];

    //Relacion Uno a Muchos (One to Many) Inversa
    public function estado(){
        return $this.belongsTo('App\Models\Estado');
    }

    // Relacion Uno a Muchos (One to Many)
    public function users(){
        return $this.hasMany('App\Models\User');
    }
}
