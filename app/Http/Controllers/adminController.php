<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pais;
use App\Ciudad;
use App\Empleado;
use App\Cliente;
use App\User;
use Spatie\Permission\Models\Role;
use Mail;


class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users= User::buscar($request->get('dato'))->orderBy('id','ASC')->paginate(10);
        return view('admin.listar_usuarios')->with('users',$users);
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
        $roles= Role::all();
        return view('admin.registrar_usuarios', compact('ciudades','paises','empleados','roles'));
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
            $usuario->tipo_rol=$request->input('roles');
            $usuario->password=bcrypt( $request->input('password'));

            $usuario->save();
            $usuario->assignRole($usuario->tipo_rol);
            $infoUsuario= $usuario->toArray();
            $correo=User::select('email')->orderBy('email','asc')->take(1)->get();      
              $correoStr=(string)$correo;
            $user = User::orderby('created_at','DESC')->take(1)->get();
            
           Mail::send('email', $infoUsuario, function($message, $correoStr, $user){
            
            $message->to($correoStr)->subject($user);});
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
            
            return redirect('admin/administrador/show');
           
        }

         if($request->tipo_user == '1')
         {   
            
           $usuario = new User();
            $usuario->username= $request->input('username');
            $usuario->email= $request->input('email');
            $usuario->tipo_user= $request->input('tipo_user');
            $usuario->tipo_rol=$request->input('roles');
            $usuario->password= bcrypt($request->input('password'));

            $usuario->save();
            $usuario->assignRole($usuario->tipo_rol);
            $infoUsuario= $usuario->toArray();
            $correo=User::select('email')->orderBy('email','asc')->take(1)->get();      
              $correoStr=(string)$correo;
            $user = User::orderby('created_at','DESC')->take(1)->get();
                
             Mail::send('email', $data, function($message, $correoStr, $user){
            $message->to($correo)->subject($user);});

         
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

             return redirect('admin/administrador/show');
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
        $empleados = DB::table('empleados')
            ->join('users', 'empleados.user_id', '=', 'users.id')
            ->where('users.tipo_rol','=',10)
            ->where('users.tipo_user','=',0)
            ->select('empleados.id', 'empleados.nombres', 'empleados.apellidos')
            ->select(
                DB::raw("CONCAT(empleados.nombres,' ',empleados.apellidos) AS fullname"),'empleados.id')
            ->pluck('fullname', 'id');
            //->get();

        //se concatena el nombre y apellido de los clientes antes de enviarlos con 'pluck'
        $clientes  = DB::table('clientes')
            ->select(
                DB::raw("CONCAT(nombres,' ',apellidos) AS fullname"),'id')->pluck('fullname', 'id');

        return view('admin.clienteEmpleado',compact('clientes','empleados'));
    }
/*
    public function storageClienteEmpleado($id)
    {

        $empleado= Empleado::all();
        return view('admin.relClienteEmpleado',compact('empleado','id'));
    }
*/
    public function storeRelClEm(Request $request)
    {
        $cliente= Cliente::find($request->cliente_id);

        $cliente->empleado_id = $request->input('empleado_id');
        $cliente->save();


       flash('El Consultor se asignó satisfactoriamente.!!')->success();
       return redirect('/admin/administrador/clienteEmpleado');
        
    }
    public function show()
    {
        flash('El usuario se creo satisfactoriamente!!.')->success();
        return view('admin.creadoSatisfactorio');
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

    public function cerrar_sesion(){

        Auth::logout();
       // return redirect('/admin/administrador/storeRelClEm');
      }
}
