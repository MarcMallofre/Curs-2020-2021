<?php

namespace App\Repositories;

use App\Models\Caja;
use App\Repositories\BaseRepository;

/**
 * Class CajaRepository
 * @package App\Repositories
 * @version March 15, 2021, 4:22 pm UTC
*/

class CajaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'capacidad'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Caja::class;
    }
}
