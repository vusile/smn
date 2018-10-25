<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\DominikaRequest as StoreRequest;
use App\Http\Requests\DominikaRequest as UpdateRequest;

/**
 * Class DominikaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class DominikaCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Dominika');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/dominika');
        $this->crud->setEntityNameStrings('dominika', 'dominikas');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        // add asterisk for fields that are required in DominikaRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
        
        
        $this->crud->addField(
        [
            'label' => "Mwaka",
            'type' => 'select',
            'name' => 'year_id', // the db column for the foreign key
            'entity' => 'Year', // the method that defines the relationship in your Model
            'attribute' => 'title', // foreign key attribute that is shown to user
            'model' => "App\Year" // foreign key mode
        ]);
        
        $this->crud->addColumn(
        [
            'label' => "Mwaka",
            'type' => 'select',
            'name' => 'year_id', // the db column for the foreign key
            'entity' => 'Year', // the method that defines the relationship in your Model
            'attribute' => 'title', // foreign key attribute that is shown to user
            'model' => "App\Year" // foreign key mode
        ]);
        
        $this->crud->allowAccess('show');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
