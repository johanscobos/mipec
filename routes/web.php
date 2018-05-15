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
use App\Events\TestEvent;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/prueba', function () {
    return view('prueba');
});



Auth::routes();

Route::get('/cerrar', 'AdminController@cerrar_sesion')->name('cerrar_sesion');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/clientes/asignarservicio', 'ClientesController@asignarservicio')->name('asignar_servicio');


Route::get('/admin/clientes/servicios', 'ClientesController@servicios');// esta rara


Route::get('/admin/servicios/serviciosporpagar', 'ServiciosController@serviciosporpagar')->name('serviciosporpagar');

Route::get('/admin/clientes/gestionar_servicios', 'ClientesController@gestionar_servicios')->name('clientes.gestionar_servicios');
Route::put('/admin/clientes/subir_planilla', 'PagosController@subir_planilla')->name('clientes.subir_planilla');
Route::get('/clientes/pagos/bajar_planilla/{id}', 'PagosController@descargar_planilla')->name('clientes.pagos.bajar_planilla');





Route::get('/clientes/pagos/ver_pagos/','PagosController@mispagos')->name('clientes.pagos.ver_pagos');

//Route::get('/admin/clientes/descargar_planilla', 'PagosController@descargar_planilla')->name('clientes.descargar_planilla');
Route::post('/admin/clientes/activar_inactivar_servicio', 'ClientesController@activar_inactivar_servicio')->name('clientes.activar_inactivar_servicio');
Route::get('/clientes/pagos/pagospendientes', 'ClientesController@pagospendientes')->name('clientes.pagospendientes');

//pago
//Route::get('/clientes/pagos/respuesta_pago', 'PagosController@respuesta_pago');


//Esta es la ruta de confirmacion de pago con tarjeta de crédito y tiene la excepcion de proteccion de token CSRF en el archivo: Http/middleware/VeryCsrfToken.php
Route::post('/clientes/pagos/confirmar_pago', 'PagosController@confirmar_pago')->name('confirmar_pago');

Route::get('/clientes/pagos/respuesta_pago/{txt_value}', 'PagosController@respuesta_pago');

/*Route::get('/clientes/pagos/respuesta_pago/{tx_value}', function ($tx_value) {
    return  "el dato es {$tx_value}";
});*/




//muestra todos los pagos
Route::get('/admin/pagos','PagosController@index')->name('pagos');

Route::get('/admin/clientes/valor/{id}', 'ClientesController@getValor');

Route::get('/clientes/pagos/pagospendientes', 'ClientesController@pagospendientes')->name('clientes.pagospendientes');

//hacer la ruta del scope

Route::get('/admin/clientes/planilla', function () {
    return view('admin.servicios.planillas');
})->name('clientes.planilla');


Route::get('/admin/administrador/verclientesconsultor', 'clientesController@ver_clientes_consultor')->name('clientesConsultor');

Route::get('/admin/administrador/clienteEmpleado', 'adminController@clienteEmpleado');
Route::get('/admin/administrador/storageClienteEmpleado/{id}', 'adminController@storageClienteEmpleado')->name('clienteEmpleado');
Route::post('/admin/administrador/storeRelClEm', 'adminController@storeRelClEm')->name('guardarRelacion');

Route::get('/admin/empleados/conclusionEmpCli', 'empleadosController@mostrarConclusion')->name('conclusiones');
Route::get('/admin/empleados/historialConversaciones', 'empleadosController@historialConclusion')->name('historial');

Route::get('/admin/empleados/verClientes', 'empleadosController@visualizarClientes')->name('verClientes');

Route::group(['prefix' =>'admin'], function (){
    Route::resource('servicios','ServiciosController');
    Route::resource('clientes','ClientesController');
    Route::resource('empleados','empleadosController');
    Route::resource('administrador', 'adminController');
});
Route::get('/admin/servicios/detalles_servicioporpagar/{id}', 'serviciosController@show_serviciosporpagar')->name('detalles_servicioporpagar');


Route::group(['prefix' =>'clientes'], function (){

    Route::resource('pagos','PagosController');

});



//-----------------chat------------------
Route::get('/prueba2', function () {
    return view('algo');
});


Route::get('event',function(){
    event(new TestEvent('broadcast enviado'));

});
//-----------------------------------------

