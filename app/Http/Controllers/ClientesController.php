<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Cliente;
use App\Servicio;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cliente::findAll();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $validatedData = $request->validate([
            'cliente_id' => 'required',
            'servicio_id' => 'required',
        ]);
        */

        //$cliente=new Cliente;
        //$servicio=new Servicio;
        //$cliente->cliente_id=$request->cliente_id;
        //$cliente->servicio_id=$request->servicio_id;




        $cl=$request->cliente_id;
        $serv=$request->servicio_id;

       $cliente=Cliente::find($cl);
       $cliente->servicios()->attach($serv,['valor_pagar' => '10000','estado_pago' => '1','estado_servicio'=>'1']);
        //$cliente->servicios()->save($servicioss_id, ['valor_pagar' => $request->valor_pagar,'estado_pago' => $request->estado_pago,'estado_servicio'=>$request->estado_pago]);


        dd('Empleado creado exitosamente!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function asignarservicio()
    {
        $clientes = DB::table('clientes')->pluck('nombres', 'id');
        $servicios = DB::table('servicios')->pluck('nombre', 'id');


        return view ('admin.clientes.asignarservicio',compact('clientes','servicios'));;


        //traiga un formulario para asignarle un servicio
        //return view('admin.clientes.asignarservicio');

    }

    public function stores(Request $request)
    {
        $validatedData = $request->validate([
            'cliente_id' => 'required',
            'servicio_id' => 'required',

        ]);

        $cliente_servicio=new Empleado($request->all());
        $empleado->save();
        dd('Empleado creado exitosamente!!!');
    }

    public function formupago(Request $request)
    {

        $vpagar=$request->valor_pagar;


        return view('clientes.pagos.formupago',compact('vpagar'));

    }
    public function serviciosporpagar(Request $request){

        //recojo el id del usuario autenticado
        $user_id = Auth::user()->id;

        //con el id_del usuario, busco el id del cliente asociado a este
        $cliente = Cliente::find($user_id);

        //declaro el array para guardar los id asociados al cliente
        $datos=array();
        //busco los servicios asociados al id del cliente
        foreach ($cliente->servicios as $servicio) {
            $datos[]=$servicio->pivot->valor_pagar;

         }


        //los envío a la vista
       //return view('clientes.servicios.serviciosporpagar',compact('datos'));

        //imprimo los valores
        dd($datos);



        //buscar en la tabla clientes_servicios los registros en donde cliente_id sea = a $cliente y mostrar el id del servicio y luego buscar en la tabla servicios el nombre del servicio. luego



        /*
        $vpagar=$cliente->pivot->valor_pagar;

        return view('clientes.servicios.create',compact('vpagar'));
        */
}
}
