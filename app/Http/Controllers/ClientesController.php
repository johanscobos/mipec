<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Cliente;
use App\Servicio;
use App\User;


class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $clientes= Cliente::buscar($request->get('dato'))->orderBy('id','ASC')->paginate(10);
        return view('admin.clientes.index')->with('clientes',$clientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clientes.principalClientes');
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


        //Se busca el último registro de la tabla "cliente_servicio" para obtener el valor de "referenceCode"
        $max_id = DB::table('cliente_servicio')->max('id');
        //dd($max_id);

        $ultimo = DB::table('cliente_servicio')->where([
            ['id', '=', $max_id],

        ])->first();

        if($ultimo=="")
        {    //no existen servicios asignados, entonces se crea en 0
            $ultimo_reference='MIPEC-0';
        }
        else{
            //traigo la ultima referencia
            $ultimo_reference=$ultimo->referenceCode;
        }

        //divido la ultima referencia para poder sumarle 1 al postfijo
        $porcion=explode("-",$ultimo_reference);
        $prefijo=$porcion[0];
        $postfijo=$porcion[1];
        $nuevo_postfijo=$postfijo+1;

        //creo la nueva referencia
        $referenceCode=$prefijo.'-'.$nuevo_postfijo;


        $cl=$request->cliente_id;

        $serv=$request->servicio_id;

        //:::::cargo los datos para generar la "signature", única para cada referencia creada

            //apikey es una constante
            $apikey="K4mvTeqzoeATzM5F72DVP3O8VO";

            //merchantId es una constante
            $merchantId="688911";
            $amount=$request->valor_pagar;

            //moneda es una constante
            $moneda="COP";

            $firma=$apikey.'~'.$merchantId.'~'.$referenceCode.'~'.$amount.'~'.$moneda;
            $signature=md5($firma);

        //:::::::::::::::::::::::::::::::::::::::::::::::::::

        //se instancia el modelo de cliente
       $cliente=Cliente::find($cl);

       //se guardan los datos en la tabla
       $cliente->servicios()->attach($serv,['descripcion_variable' => $request->descripcion_variable,'valor_pagar' => $request->valor_pagar,'referenceCode' => $referenceCode,'signature' => $signature,'estado_pago' => '0','estado_servicio'=>'0']);


        flash('El servicio se asignó satisfactoriamente!!.')->success();
        return redirect('/admin/clientes/asignarservicio');
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

    // ver clinetes asignados a consultores
    public function ver_clientes_Consultor(Request $request){

       $consultores = User::buscaruser($request->get('dato'))


          //$consultores = User::
            ->join('empleados', 'users.id', '=', 'empleados.user_id')
            ->join('clientes', 'clientes.empleado_id', '=', 'empleados.id')
           //->join('clientes as cl', 'cl.empleado_id', '=', 'empleados.id')
            ->select('empleados.nombres', 'empleados.apellidos', 'empleados.cedula','clientes.nombres as nombresclientes','clientes.apellidos as apellidosclientes','clientes.cedula as cedulaclientes')
           //->select('empleados.nombres', 'empleados.apellidos', 'empleados.cedula','cl.nombres','cl.apellidos','cl.cedula')
            ->where('users.tipo_rol','=',10)
           // ->orderBy('clientes.id','ASC')->paginate(10)
            ->get();

        //dd($consultores);
        return view('admin.clientes.verclientesconsultor')->with('consultores',$consultores);
    }

    //Método que talllllllllllllllllllllllllllllllllllllll
    public function asignarservicio()
    {

        //se concatena el nombre y apellido de los clientes antes de enviarlos con 'pluck'
        $clientes  = DB::table('clientes')
            ->select(
                DB::raw("CONCAT(nombres,' ',apellidos) AS fullname"),'id')->pluck('fullname', 'id');


       // $clientes = Cliente::pluck('nombres','id');
        $servicios = DB::table('servicios')->pluck('nombre', 'id');


        return view ('admin.clientes.asignarservicio',compact('clientes','servicios'));;
    }

    //obtiene el valor del servicio seleccionado desde la vista de "asignar servicios a un cliente"
    public function getValor(Request $request, $id){
        if($request->ajax()){
            $valor=Servicio::find($id);
           return response()->json($valor);
        }
    }

    //Método que talllllllllllllllllllllllllllllllllllllll
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


    //Método que talllllllllllllllllllllllllllllllllllllll
    public function pagospendientes(Request $request)
    {
        $user_id = Auth::id();
        $cliente = Cliente::where('user_id', $user_id)->first();
        $cliente_id=$cliente->id;

        $clservicios = DB::table('cliente_servicio')->where([
            ['cliente_id', '=', $cliente_id],
            ['estado_pago', '=', '0'],
        ])->get();
        return view('clientes.pagos.pagospendientes', ['pagospendientes' => $clservicios]);
    }

    //Método que lista los servicios que un cliente tiene asignados y un botón de la vista, lo activa o inactiva en el método "activar_inactivar_servicio"
  /*  public function gestionar_servicios_old3(Request $request)
    {
        //ir al modelo clientes y buscar el nombre que coincida y luego traer el id para pasarselo
        $cedula = $request->cedula;

        if (!empty($cedula))
        {
         
          // Obtengo los datos del cliente, según el dato enviado desde la busqueda de la vista  
           $cliente  = Cliente::where('nombres', 'LIKE', '%'.$cedula.'%')
            ->orWhere('apellidos', 'LIKE', '%'.$cedula.'%')
            ->orWhere('cedula', $cedula)->first();

            if($cliente!=NULL)
            {
                //Obtengo el id del objeto obtenido en el query
                $cliente_id = $cliente->id;

                //Busco los clientes que coincidan con el id
                $clservicios = DB::table('cliente_servicio')->where([
                    ['cliente_id', '=', $cliente_id],
                    ['estado_pago', '=', 1],
                ])->get();

                // envio la coleccion de objetos
                return view('admin.clientes.gestionar_servicios', ['clservicios' => $clservicios]);
            }
            else{
                
                // Si el query no arroja resultados, que muestre el mensaje de error y todos los clientes con servicios
                flash('No hay clientes asociados con los datos suministrados!!.')->success();
                $clservicios = DB::table('cliente_servicio')->where('estado_pago', 1)->get();
            return view('admin.clientes.gestionar_servicios', ['clservicios' => $clservicios]);
            }
        }

        //Si no se envia datos para la busqueda, entonces muestra todos los clientes con servicios
        else{
             //si no esta definida la variable que muestre todos
            $clservicios = DB::table('cliente_servicio')->where('estado_pago', 1)->get();
            return view('admin.clientes.gestionar_servicios', ['clservicios' => $clservicios]);
    }
    }*/


    public function gestionar_servicios(Request $request){

        $clservicios = Cliente::buscarpagospendientes($request->get('dato'))
            ->join('cliente_servicio', 'cliente_servicio.cliente_id', '=', 'clientes.id')
            ->join('servicios', 'cliente_servicio.servicio_id', '=', 'servicios.id')
            ->select('clientes.id', 'clientes.nombres', 'clientes.apellidos','clientes.cedula','cliente_servicio.servicio_id','cliente_servicio.cliente_id','cliente_servicio.referenceCode','cliente_servicio.valor_pagar','cliente_servicio.estado_pago','cliente_servicio.estado_servicio','servicios.id','servicios.nombre','servicios.descripcion')
            ->where('cliente_servicio.estado_pago','=',1)
            ->get();



        $count=0;
        foreach ($clservicios as $clservicio) {
            $count=1;
        }
        // si la busquedad no arroja resultados, traiga todos lore resultados sin hacer ningún filtro y saqque el mensaje Flash
        if($count==0){
            $clservicios = Cliente::
            join('cliente_servicio', 'cliente_servicio.cliente_id', '=', 'clientes.id')
                ->join('servicios', 'cliente_servicio.servicio_id', '=', 'servicios.id')
                ->select('clientes.id', 'clientes.nombres', 'clientes.apellidos','clientes.cedula','cliente_servicio.servicio_id','cliente_servicio.cliente_id','cliente_servicio.referenceCode','cliente_servicio.valor_pagar','cliente_servicio.estado_pago','servicios.id','servicios.nombre','servicios.descripcion')
                ->where('cliente_servicio.estado_pago','=',1)
                ->get();

            flash('No se encuentran registros asociados a la búsqueda !!')->success();
            return view('admin.clientes.gestionar_servicios', ['clservicios' => $clservicios]);
        }

        //dd($serviciosporpagar);

        return view('admin.clientes.gestionar_servicios', ['clservicios' => $clservicios]);
    }


    //Método que activa o inactiva un servicio de un cliente
    public function activar_inactivar_servicio(Request $request)
    {
        $cliente_id=$request->cliente_id;
        $rc=$request->rc;
        $accion=$request->accion;

        //dd($cliente_id);

        DB::table('cliente_servicio')
            ->where([
                ['cliente_id', '=', $cliente_id],
                ['referenceCode', '=', $rc],
                ])
            ->update(['estado_servicio' => $accion]);
        return redirect('/admin/clientes/gestionar_servicios');
    }


    public function subir_planillaOLD(Request $request)
    {

        //ir al modelo clientes y buscar el nombre que coincida y luego traer el id para pasarselo
        $cedula = $request->cedula;

        if (!empty($cedula))
        {
            $cliente = Cliente::where('cedula', $cedula)->first();

            if($cliente!=NULL)
            {
                $cliente_id = $cliente->id;
                $clservicios = DB::table('cliente_servicio')->where([
                    ['cliente_id', '=', $cliente_id],
                    ['servicio_id', '=', 1],
                ])->get();
                return view('admin.clientes.subir_planilla', ['clservicios' => $clservicios]);
            }
            else{
                //$clservicios = DB::table('cliente_servicio')->where('estado_pago', 1)->get();
                //return view('admin.clientes.gestionar_servicios', ['clservicios' => $clservicios]);

                // $clservicios = DB::table('cliente_servicio')->where('estado_pago', 1)->get();

                //llama a la vista sin variable para que diga que no hay resultados encontrados
                return view('admin.clientes.subir_planilla');
            }
        }

        //muestra todos los clientes con servicio de pago de pensión
        else{
            //si no esta definida la variable que muestre todos
            $clservicios = DB::table('cliente_servicio')->where('servicio_id', 1)->get();
            return view('admin.clientes.subir_planilla', ['clservicios' => $clservicios]);
        }



        /*$clservicios = DB::table('cliente_servicio')->where([
            ['cliente_id', '=', $cliente_id],
            ['servicio_id', '=', 1],
        ])->get();*/

        //$clservicios = DB::table('cliente_servicio')->where('servicio_id', 1)->get();
        //return view('admin.clientes.subir_planilla', ['clservicios' => $clservicios]);



    }

    public function planilla(Request $request)
    {

       // return view('admin.servicios.planillas');
        $request_>file('planilla')->store('public');

       // $cliente

    }


/*:::::::::::::::::Busquedas de autocompletado:::::::::::::::::::::::*/
    public function layout()
    {
        return view('admin.clientes.asignarservicio');

    }


    /**
     * Show the application dataAjax.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataAjax(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("clientes")
                    ->select("id","nombres")
                    ->where('nombres','LIKE',"%$search%")
                    ->get();
        }
        return response()->json($data);
    }

    public function serviciosporpagar(Request $request){

        $clientes=Cliente::all();

    }
}
