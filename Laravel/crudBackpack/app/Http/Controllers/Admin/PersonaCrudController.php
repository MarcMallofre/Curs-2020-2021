<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PersonaRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PersonaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PersonaCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Persona::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/persona');
        CRUD::setEntityNameStrings('persona', 'personas');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
       //CRUD::setFromDb(); // columns
       $this->crud->addColumn([
        'name'  => 'nombre',
        'label' => "Nombre",
        'type'  => 'text',
        ]);

        $this->crud->addColumn([
            'name'  => 'apellido',
            'label' => "Apellido",
            'type'  => 'text',
        ]);

        $this->crud->addColumn([
            'name' => 'email',
            'label' => 'Email',
            'type' => 'text',
        ]);

        $this->crud->addColumn([
            'label' => 'Asignaturas',
            'type' => 'select_multiple',
            'name' => 'asignaturas', // the db column for the foreign key
            'entity' => 'asignaturas', // the method that defines the relationship in your Model
            'attribute' => 'nombre', // foreign key attribute that is shown to user
            'model' => 'App\Models\Asignatura',// foreign key model
            'pivot' => true 
  
        ]);
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PersonaRequest::class);

        //CRUD::setFromDb(); // fields
        $this->crud->addField([
            'name'  => 'nombre',
            'label' => "Nombre",
            'type'  => 'text',
        ]);

        $this->crud->addField([
            'name'  => 'apellido',
            'label' => "Apellido",
            'type'  => 'text',
        ]);

        $this->crud->addField([
            'name' => 'email',
            'label' => 'Email',
            'type' => 'text',
        ]);

        $this->crud->addField([
            'label' => 'Asignaturas',
            'type' => 'select2_multiple',
            'name' => 'asignaturas', // the db column for the foreign key
            'entity' => 'asignaturas', // the method that defines the relationship in your Model
            'attribute' => 'nombre', // foreign key attribute that is shown to user
            'model' => 'App\Models\Asignatura',// foreign key model
            'pivot' => true 
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}