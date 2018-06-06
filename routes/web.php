<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(url('/admin/login'));
});
Route::get('/home', function () {
    return redirect(url('/admin/dashboard'));
});


Route::get('/lang/{l}', function ($l) {
    $arr_lang = ['en', 'km'];
    $la = in_array($l, $arr_lang) ? $l : 'en';
    session(['sess_lang' => $la]);
    return redirect()->back();
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function()
{
  // Backpack\CRUD: Define the resources for the entities you want to CRUD.
     CRUD::resource('category', 'Admin\CategoryCrudController');
     CRUD::resource('product', 'Admin\ProductCrudController');
     CRUD::resource('table', 'Admin\TableCrudController');
     CRUD::resource('warehouse', 'Admin\WarehouseCrudController');
     CRUD::resource('warehousequatity', 'Admin\WarehouseQuatityCrudController');
     CRUD::resource('tableform', 'Admin\TableFormCrudController');
  
  // [...] other routes
});
Route::get('/api/category', 'Api\CategoryController@index');
Route::get('/api/category/{id}', 'Api\CategoryController@show');


Route::get('/api/warehouse', 'Api\WarehouseQuatityController@index');
Route::get('/api/warehouse/{id}', 'Api\WarehouseQuatityController@show');

Route::get('/api/product', 'Api\ProductQuatityController@index');
Route::get('/api/product/{id}', 'Api\ProductQuatityController@show');

