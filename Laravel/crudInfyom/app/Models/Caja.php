<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Caja
 * @package App\Models
 * @version March 15, 2021, 4:22 pm UTC
 *
 * @property string $nombre
 * @property integer $capacidad
 */
class Caja extends Model
{
    //use SoftDeletes;
    public $timestamps=false;
    use HasFactory;

    public $table = 'cajas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'capacidad'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'capacidad' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:155',
        'capacidad' => 'required|integer'
    ];

    
}
