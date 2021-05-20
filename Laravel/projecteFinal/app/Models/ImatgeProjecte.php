<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Projecte;


class ImatgeProjecte extends Model
{
    use HasFactory;

    protected $table = 'imatges_projectes';

    //Relacion ImagenProyecto-Proyecto
    public function proyecto()
    {
        return $this->belongsTo('App\Models\Projecte;', 'projecte_id');
    }
}
