<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producte extends Model
{
    use HasFactory;

    //Relacion producto-imagenesProducto
    public function imagenesProducto()
    {
        return $this->hasMany('App\Models\ImatgeProducte');
    }
    
    //Relacion producto-imagenProducto
    public function imagenProducto() 
    {
        return $this->hasOne('App\Models\ImatgeProducte');
    }

    //Relacion producto-detalleComanda
    public function detallComanda()
    {
        return $this->hasMany('App\Models\DetallComanda');
    }
}
