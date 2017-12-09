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
Route::put('/admin/clientes/subir_planilla', 'PagosController@subir_planilla')->name('clientes.subir_planilla');
Route::get('/clientes/pagos/bajar_planilla/{id}', 'PagosController@descargar_planilla')->name('clientes.pagos.bajar_planilla');

Route::get('/clientes/pagos/ver_pagos/','PagosController@mispagos')->name('clientes.pagos.ver_pagos');

//Route::get('/admin/clientes/descargar_planilla', 'PagosController@descargar_planilla')->name('clientes.descargar_planilla');
Route::post('/admin/clientes/activar_inactivar_servicio', 'ClientesController@activar_inactivar_servicio')->name('clientes.activar_inactivar_servicio');
Route::get('/clientes/pagos/pagospendientes', 'ClientesController@pagospendientes')->name('clientes.pagospendientes');

Route::get('/clientes/pagos/pagospendientes', 'ClientesController@pagospendientes')->name('clientes.pagospendientes');

//hacer la ruta del scope

Route::get('/admin/clientes/planilla', function () {
    return view('admin.servicios.planillas');
})->name('clientes.planilla');


Route::get('/admin/administrador/clienteEmpleado', 'adminController@clienteEmpleado');
Route::get('/admin/administrador/storageClienteEmpleado/{id}', 'adminController@storageClienteEmpleado')->name('clienteEmpleado');
Route::post('/admin/administrador/storeRelClEm', 'adminController@storeRelClEm')->name('guardarRelacion');

Route::get('/admin/empleados/verClientes', 'empleadosController@visualizarClientes')->name('verClientes');
Route::group(['prefix' =>'admin'], function (){
    Route::resource('servicios','ServiciosController');
    Route::resource('clientes','ClientesController');
    Route::resource('empleados','empleadosController');
    Route::resource('administrador', 'adminController');

});


Route::group(['prefix' =>'clientes'], function (){

    Route::resource('pagos','PagosController');

});
