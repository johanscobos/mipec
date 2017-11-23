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

Route::get('/prueba', function () {
    return view('/clientes/servicios/serviciosporpagar');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/clientes/asignarservicio', 'ClientesController@asignarservicio');
Route::get('/admin/clientes/servicios', 'ClientesController@servicios');
Route::get('/admin/clientes/serviciosporpagar', 'ClientesController@serviciosporpagar');
Route::post('/pruebas', 'ClientesController@formupago')->name('clientes.formupago');
Route::get('/admin/clientes/gestionarcliente', 'ClientesController@gestionarcliente')->name('clientes.gestionarcliente');
Route::post('/admin/clientes/activarcliente', 'ClientesController@activarcliente')->name('clientes.activarcliente');


Route::group(['prefix' =>'admin'], function (){

    Route::resource('servicios','ServiciosController');
    Route::resource('clientes','ClientesController');
    Route::resource('administrador', 'adminController');

});






Route::group(['prefix' =>'clientes'], function (){

    Route::resource('pagos','PagosController');



});
