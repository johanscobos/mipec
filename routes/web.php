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

Route::group(['prefix' =>'admin'], function (){

    Route::resource('servicios','ServiciosController');
    Route::resource('clientes','ClientesController');

});


Route::group(['prefix' =>'clientes'], function (){

    Route::resource('pagos','PagosController');
});
