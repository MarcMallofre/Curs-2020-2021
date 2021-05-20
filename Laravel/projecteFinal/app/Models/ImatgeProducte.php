<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImatgeProducte extends Model
{
    use HasFactory;

    protected $table = 'imatges';

    //Relacion ImagenProducto-Producto
    public function producto()
    {
        return $this->belongsTo('App\Models\Producte;', 'producte_id');
    }
}
