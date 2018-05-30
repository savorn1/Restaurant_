<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CustomerRequest as StoreRequest;
use App\Http\Requests\CustomerRequest as UpdateRequest;

class CustomerCrudController extends CrudController
{
    public function setup()
    {
        $lang_file = 'customer';

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Customer');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/customer');
        $this->crud->setEntityNameStrings('customer', 'customers');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->addColumn([
            'label' => _t('Customer Name', $lang_file),
            'name' => 'customer_name',
        ]);
        $this->crud->addColumn([
            'label' => 'Gender',
            'name' => 'sex',
        ]);

        $this->crud->addColumn([
            'label' => _t('Phone', $lang_file),
            'name' => 'phone',
        ]);

        $this->crud->addColumn([
            'label' => 'Status',
            'name' => 'status',
        ]);

        $this->crud->addColumn([
            'label' => _t('address', $lang_file),
            'name' => 'address',
        ]);


        $this->crud->addField([
            'label' => _t('customer_name', $lang_file),

            'name' => 'customer_name',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4'
            ],
            'attributes' => [
                'class' => 'form-control'
            ],

            'tab' => _t('customer Info', $lang_file),
            'location_group' => 'customer',
        ]);


        $this->crud->addField([
            'label' => _t('sex', $lang_file),
            'name' => 'sex',
            'type' => 'enum',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',

            ],
            'attributes' => [
                'class' => 'form-control'
            ],
            'tab' => _t('customer Info', $lang_file),
            'location_group' => 'customer',
        ]);


        $this->crud->addField([
            'label' => _t('dob', $lang_file),
            'name' => 'dob',
            'type' => 'date_picker',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',
            ],
            'attributes' => [
                'class' => 'form-control'
            ],

            'tab' => _t('customer Info', $lang_file),
            'location_group' => 'customer',
        ]);

        $this->crud->addField([
            'label' => _t('age', $lang_file),
            'name' => 'age',
            'type' => 'number',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',

            ],
            'attributes' => [
                'class' => 'form-control'
            ],

            'tab' => _t('customer Info', $lang_file),
            'location_group' => 'customer',
        ]);


        $this->crud->addField([
            'label' => _t('phone', $lang_file),
            'name' => 'phone',

            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',

            ],
            'attributes' => [
                'class' => 'form-control'
            ],

            'tab' => _t('customer Info', $lang_file),
            'location_group' => 'customer',
        ]);


        $this->crud->addField([
            'label' => _t('email', $lang_file),
            'name' => 'email',
            'type' => 'email',

            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',

            ],
            'attributes' => [
                'class' => 'form-control'
            ],

            'tab' => _t('customer Info', $lang_file),
            'location_group' => 'customer',
        ]);

        $this->crud->addField([
            'label' => _t('identity_type', $lang_file),
            'name' => 'identity_type',
            'type' => 'enum',

            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',

            ],
            'attributes' => [
                'class' => 'form-control'
            ],

            'tab' => _t('customer Info', $lang_file),
            'location_group' => 'customer',
        ]);

        $this->crud->addField([
            'label' => _t('identity_number', $lang_file),
            'name' => 'identity_number',


            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',

            ],
            'attributes' => [
                'class' => 'form-control'
            ],

            'tab' => _t('customer Info', $lang_file),
            'location_group' => 'customer',
        ]);


        $this->crud->addField([
            'label' => _t('blacklist', $lang_file),
            'name' => 'blacklist',
            'type' => 'enum',

            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',

            ],
            'attributes' => [
                'class' => 'form-control'
            ],

            'tab' => _t('customer Info', $lang_file),
            'location_group' => 'customer',
        ]);


        $this->crud->addField([
            'label' => _t('status', $lang_file),
            'name' => 'status',
            'type' => 'enum',

            'wrapperAttributes' => [
                'class' => 'form-group col-md-4',

            ],
            'attributes' => [
                'class' => 'form-control'
            ],

            'tab' => _t('customer Info', $lang_file),
            'location_group' => 'customer',
        ]);


        $this->crud->addField([
            'label' => _t('note', $lang_file),
            'name' => 'note',
            'type' => 'textarea',


            'wrapperAttributes' => [
                'class' => 'form-group col-md-12',

            ],
            'attributes' => [
                'class' => 'form-control'
            ],

            'tab' => _t('customer Info', $lang_file),
            'location_group' => 'customer',
        ]);


        // =======  Address ========
        $this->crud->addField([
            // 1-n relationship
            'label' => _t("Province", 'location'), // Table column heading
            'type' => "select2_province",
            'name' => 'province_id', // the column that contains the ID of that connected entity
            'entity' => 'province', // the method that defines the relationship in your Model
            'attribute' => "description", // foreign key attribute that is shown to user
            'model' => "App\Address", // foreign key model
            'data_source' => url("api/province"), // url to controller search function (with /{id} should return model)
            'placeholder' => _t("Select a province",$lang_file), // placeholder for the select
            'minimum_input_length' => 0, // minimum characters to type before querying results
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => [
                'class' => 'form-control'
            ],
            'tab' => _t('customer Address',$lang_file),
            'location_group' => 'customer',
        ]);


        $this->crud->addField([
            // 1-n relationshipc_district_id
            'label' => _t("District", 'location'), // Table column heading
            'type' => "select2_district",
            'name' => 'district_id', // the column that contains the ID of that connected entity
            'entity' => 'district', // the method that defines the relationship in your Model
            'attribute' => "description", // foreign key attribute that is shown to user
            'model' => "App\Address", // foreign key model
            'data_source' => url("api/district"), // url to controller search function (with /{id} should return model)
            'placeholder' => _t("Select a district",$lang_file), // placeholder for the select
            'minimum_input_length' => 0, // minimum characters to type before querying results
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => [
                'class' => 'form-control'
            ],
            'tab' => _t('customer Address',$lang_file),
            'location_group' => 'customer',
        ]);

        $this->crud->addField([
            // 1-n relationshipc_district_id
            'label' => _t("Commune", 'location'), // Table column heading
            'type' => "select2_commune",
            'name' => 'commune_id', // the column that contains the ID of that connected entity
            'entity' => 'commune', // the method that defines the relationship in your Model
            'attribute' => "description", // foreign key attribute that is shown to user
            'model' => "App\Address", // foreign key model
            'data_source' => url("api/commune"), // url to controller search function (with /{id} should return model)
            'placeholder' => _t("Select a commune",$lang_file), // placeholder for the select
            'minimum_input_length' => 0, // minimum characters to type before querying results
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => [
                'class' => 'form-control'
            ],
            'tab' => _t('customer Address',$lang_file),
            'location_group' => 'customer',
        ]);

        $this->crud->addField([
            // 1-n relationshipc_district_id
            'label' => _t("Village", 'location'), // Table column heading
            'type' => "select2_village",
            'name' => 'village_id', // the column that contains the ID of that connected entity
            'entity' => 'village', // the method that defines the relationship in your Model
            'attribute' => "description", // foreign key attribute that is shown to user
            'model' => "App\Address", // foreign key model
            'data_source' => url("api/village"), // url to controller search function (with /{id} should return model)
            'placeholder' => _t("Select a village",$lang_file), // placeholder for the select
            'minimum_input_length' => 0, // minimum characters to type before querying results
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => [
                'class' => 'form-control'
            ],
            'tab' => _t('customer Address',$lang_file),
            'location_group' => 'customer',
        ]);


        $this->crud->addField([
            'name' => 'street_number',
            'label' => _t('Street Number', 'location'),
            'type' => 'text_street',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => [
                'class' => 'form-control'
            ],
            'tab' => _t('customer Address',$lang_file),
            'location_group' => 'customer',
        ]);

        $this->crud->addField([
            'name' => 'house_number',
            'label' => _t('House Number', 'location'),
            'type' => 'text_house',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => [
                'class' => 'form-control'
            ],
            'tab' => _t('customer Address',$lang_file),
            'location_group' => 'customer',
        ]);


        $this->crud->addField([
            'name' => 'address',
            'label' => _t('Address', $lang_file),
            'type' => 'textarea2',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12'
            ],
            'attributes' => [
                'class' => 'form-control'
            ],
            'tab' => _t('customer Address',$lang_file),
            'location_group' => 'customer',
        ]);


        $this->crud->addField([ // image
            'label' => _t('Image', $lang_file),
            'name' => "image",
            'type' => 'image',
            'default' => asset('No_Image_Available.jpg'),
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
            // 'prefix' => 'uploads/images/profile_pictures/' // in case you only store the filename in the database, this text will be prepended to the database value
            'tab' => _t('Image', $lang_file),
            'location_group' => 'customer',

        ]);


        //$this->crud->setFromDb();

        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
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
