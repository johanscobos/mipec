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
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/clientes/asignarservicio', 'ClientesController@asignarservicio');

Route::get('/admin/clientes/servicios', 'ClientesController@servicios');

Route::get('/admin/clientes/gestionar_servicios', 'ClientesController@gestionar_servicios')->name('clientes.gestionar_servicios');
Route::post('/admin/clientes/activar_inactivar_servicio', 'ClientesController@activar_inactivar_servicio')->name('clientes.activar_inactivar_servicio');
Route::get('/clientes/pagos/pagospendientes', 'ClientesController@pagospendientes')->name('clientes.pagospendientes');

Route::get('/clientes/pagos/pagospendientes', 'ClientesController@pagospendientes')->name('clientes.pagospendientes');

//hacer la ruta del scope

/*Route::get('/admin/clientes/gestionar_servicios', function () {
    return view('admin.clientes.gestionar_servicios');
});*/



Route::group(['prefix' =>'admin'], function (){

    Route::resource('servicios','ServiciosController');
    Route::resource('clientes','ClientesController');
    Route::resource('administrador', 'adminController');

});


Route::group(['prefix' =>'clientes'], function (){

    Route::resource('pagos','PagosController');



});
