<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallComanda extends Model
{
    use HasFactory;

    protected $table = 'detall_comandes';

    public function comanda()
    {
        return $this->belongsTo('App\Models\Comanda', 'comanda_id');
    }

    public function productos()
    {
        return $this->belongsTo('App\Models\Producte', 'producte_id');
    }
}
