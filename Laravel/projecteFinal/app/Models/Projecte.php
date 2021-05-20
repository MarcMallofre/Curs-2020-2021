<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ImatgeProjecte;

class Projecte extends Model
{
    use HasFactory;

    //Relacion proyecto-imagenes
    public function imagenes()
    {
        return $this->hasMany('App\Models\ImatgeProjecte');
    }
}
