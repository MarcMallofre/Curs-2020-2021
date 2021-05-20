<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    use HasFactory;

    protected $table = 'comandes';

    //Relacion comanda-usuario
    public function usuario()
    {
        return $this->belongsTo('App\Models\User', 'usuari_id');
    }

    //Relacion comanda-detalleComanda
    public function detallComanda()
    {
        return $this->hasMany('App\Models\DetallComanda');
    }
}
