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
        
        if($request->tipo_user == '0')
         {   

            
           $usuario = new User();
            $usuario->username= $request->input('username');
            $usuario->email= $request->input('email');
            $usuario->tipo_user= $request->input('tipo_user');
            $usuario->password= $request->input('password');

            $usuario->save();
           // Flash::success("Se ha registrado el usuario ".$usuario->username." de manera exitosa!");

            $empleado= new Empleado();
            $empleado->cedula=$request->input('cedulaem');
            $empleado->nombres=$request->input('nombresem');
            $empleado->apellidos=$request->input('apellidosem');
            $empleado->telefono=$request->input('telefonoem');
            $empleado->celular=$request->input('celularem');
            $empleado->direccion=$request->input('direccionem');
            $empleado->pais_codigo=$request->input('paises');
            $empleado->ciudad_id=$request->input('ciudades');
            $empleado->user_id=$usuario->id;
            $empleado->estado= 1;

            $empleado->save();
           
        }

         if($request->tipo_user == '1')
         {   
            
           $usuario = new User();
            $usuario->username= $request->input('username');
            $usuario->email= $request->input('email');
            $usuario->tipo_user= $request->input('tipo_user');
            $usuario->password= $request->input('password');

            $usuario->save();

            $cliente= new Cliente();
            $cliente->cedula=$request->input('cedula');
            $cliente->nombres=$request->input('nombres');
            $cliente->apellidos=$request->input('apellidos');
            $cliente->telefono=$request->input('telefono');
            $cliente->celular=$request->input('celular');
            $cliente->direccion=$request->input('direccion');
            $cliente->pais_codigo=$request->input('paises');
            $cliente->ciudad_id=$request->input('ciudades');
            $cliente->empleado_id=$request->input('empleados');
            $cliente->user_id=$usuario->id;
            $cliente->estado= 1;

            $cliente->save();
        }
       //dd($request);
        /*if($request->tipo_user == '1')
            dd('cliente');
        else
            dd('empleado');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clienteEmpleado()
    {
        $cliente= Cliente::all();
        return view('admin.clienteEmpleado',compact('cliente'));
    }
    public function storageClienteEmpleado(Request $request)
    {
        dd($request);
    }
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
