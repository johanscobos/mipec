<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;
use Laracasts\Flash\Flash;

class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $servicios= Servicio::buscar($request->get('dato'))->orderBy('id','ASC')->paginate(10);
        return view('admin.servicios.index')->with('servicios',$servicios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.servicios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',

        ]);

        //return $request->all();
        $servicio=new Servicio;
        $servicio->nombre=$request->nombre;
        $servicio->descripcion=$request->descripcion;
        $servicio->valor=$request->valor;
        $servicio->save();

        flash('El servicio se creó satisfactoriamente!!.')->success();
        return redirect('/admin/servicios/create');


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

        $servicio = Servicio::find($id);
        return view('admin.servicios.edit')->with('servicio',$servicio);
        //dd($servicio);
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
        $servicio = Servicio::find($id);
        $servicio->nombre = $request->nombre;
        $servicio->descripcion = $request->descripcion;
        $servicio->save();

        flash('El servicio '.$servicio->nombre. ' ha sido actualizado con éxito!!')->success();
        return redirect()->route('servicios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   $servicio=Servicio::find($id);
        $servicio->delete();
        flash('El servicio '.$servicio->nombre. ' ha sido eliminado satisfactoriamente!!')->success();
        return redirect()->route('servicios.index');
    }
}
