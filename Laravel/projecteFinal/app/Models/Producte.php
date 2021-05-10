<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producte extends Model
{
    use HasFactory;

    public function imagenesProducto()
    {
        return $this->hasMany('App\Models\ImatgeProducte');
    }
    

    public function imagenProducto() {
        return $this->hasOne('App\Models\ImatgeProducte');
    }
}
