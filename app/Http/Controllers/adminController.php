<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pais;
use App\Ciudad;
use App\Empleado;
use App\Cliente;
use App\User;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $paises= Pais::all();
        $ciudades= Ciudad::all();
        $empleados= Empleado::all();
        return view('admin.registrar_usuarios', compact('ciudades','paises','empleados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if($request->tipo_user == 'empleado')
         {   
            $usuario = new User();
            $usuario->username= $request->username;
            $usuario->email= $request->email;
            $usuario->tipo_user= $request->tipo_user;
            $usuario->password= $request->password;

            $usuario->save();

            $empleado= new Empleado();
            $empleado->cedula=$request->cedula;
            $empleado->nombres=$request->nombres;
            $empleado->apellidos=$request->apellidos;
            $empleado->telefono=$request->telefono;
            $empleado->celular=$request->celular;
            $empleado->direccion=$request->direccion;
            $empleado->paises=$request->paises;
            $empleado->ciudades=$request->ciudades;

            $empleado->save();
        }

         if($request->tipo_user == 'cliente')
         {   
            $usuario = new User();
            $usuario->username= $request->username;
            $usuario->email= $request->email;
            $usuario->tipo_user= $request->tipo_user;
            $usuario->password= $request->password;

            $usuario->save();

            $cliente= new Cliente();
            $cliente->cedula=$request->cedula;
            $cliente->nombres=$request->nombres;
            $cliente->apellidos=$request->apellidos;
            $cliente->telefono=$request->telefono;
            $cliente->celular=$request->celular;
            $cliente->direccion=$request->direccion;
            $cliente->paises=$request->paises;
            $cliente->ciudades=$request->ciudades;
            $cliete->empleados=$request->empleados;

            $cliente->save();
        }
       // dd($request);
        /*if($request->tipo_user == 'cliente')
            dd('hola');
        else
            dd('nada');*/
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
}
