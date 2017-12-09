<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pago;
use App\Cliente;


class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //dd($request->get('cedula'));

        $pagos= Pago::buscar($request->get('cedula'))->orderBy('id','ASC')->paginate(10);
       return view('clientes.pagos.index')->with('pagos',$pagos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$servicios = Servicio::all();
        //$empleados = Empleado::all();

        //return view('clientes.pagos.create',compact('servicios','empleados'));
        return view('clientes.pagos.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        $pago= Pago::find($id);

       return view('clientes.pagos.edit')->with('pago', $pago);

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

        $validatedData = $request->validate([
            'planilla' => 'mimes:jpeg,bmp,png,pdf│required',
        ]);

        // falta generar este numero
        //$rc="0000000001";
        $pago= Pago::find($id);

        if($request->hasFile('planilla'))
        {
            $pago->planilla= $request->file('planilla')->store('public');
            $pago->update($request->only('planilla'));
            flash('La planilla ha sido actualiza!!.')->success();
            return redirect('/clientes/pagos');

        }

        else{
            echo "No hay imagen";
        }

       //dd($id);

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


    public function mispagos(Request $request)
    {
        //dd("estoy en mis pagos");

        $user_id = Auth::id();


        $cliente = Cliente::where('user_id', $user_id)->first();
        $cliente_id = $cliente->id;
        //dd($cliente_id);

        $pagos= Pago::buscar_ref($request->get('dato'))
        ->where('cliente_id', $cliente_id)->orderBy('id','ASC')->paginate(10);
        //$pagos = Pago::where('cliente_id', $cliente_id)->get();

        return view('clientes.pagos.ver_pagos')->with('pagos', $pagos);

    }

    public function subir_planilla(Request $request)
    {
        $validatedData = $request->validate([
            'planilla' => 'mimes:jpeg,bmp,png,pdf│required',
        ]);

// falta generar este numero
        $rc="0000000001";
        $pago= Pago::where('referenceCode', '=' , $rc);

        if($request->hasFile('planilla'))
        {
            $pago->planilla= $request->file('planilla')->store('public');
            $pago->update($request->only('planilla'));
            return redirect('/admin/clientes/gestionar_servicios');
        }

        else{
            echo "No hay imagen";
        }


    }



    public function descargar_planilla($id){
        $pago= Pago::find($id);
        $planilla=$pago->planilla;
        $path = storage_path('app/'.$planilla);
        return response()->download($path);
    }
}
