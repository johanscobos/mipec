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


        //buscar el ultimo registro de cliente_servicio y sacar el valor de referenceCode
// esto hay que mejorarlo::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
        $max_id = DB::table('cliente_servicio')->max('id');
        //dd($max_id);

        $ultimo = DB::table('cliente_servicio')->where([
            ['id', '=', $max_id],

        ])->first();

        //dd($ultimo->referenceCode);
        $ultimo_reference=$ultimo->referenceCode;

        //$ultimo= $clservicios->referenceCode;
        //dd($ultimo);
        //$prefijo="MIPEC";
        $referenceCode=$ultimo_reference+1;
        //dd($datoRef);
        //$referenceCode=$datoRef;
        //dd($referenceCode);


        $cl=$request->cliente_id;
        $serv=$request->servicio_id;

        //sacar valor a pagar
        //enviar codeReferce

       $cliente=Cliente::find($cl);
       $cliente->servicios()->attach($serv,['descripcion_variable' => $request->descripcion_variable,'valor_pagar' => $request->valor_pagar,'referenceCode' => $referenceCode,'estado_pago' => '0','estado_servicio'=>'0']);
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

    //Método que talllllllllllllllllllllllllllllllllllllll
    public function asignarservicio()
    {
        $clientes = DB::table('clientes')->pluck('nombres', 'id');
        $servicios = DB::table('servicios')->pluck('nombre', 'id');

        //crear referenceCode

        return view ('admin.clientes.asignarservicio',compact('clientes','servicios'));;


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
    public function gestionar_servicios(Request $request)
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
                    ['estado_pago', '=', 1],
                ])->get();
                return view('admin.clientes.gestionar_servicios', ['clservicios' => $clservicios]);
            }
            else{
                //$clservicios = DB::table('cliente_servicio')->where('estado_pago', 1)->get();
                //return view('admin.clientes.gestionar_servicios', ['clservicios' => $clservicios]);

                // $clservicios = DB::table('cliente_servicio')->where('estado_pago', 1)->get();

                //llama a la vista sin variable para que diga que no hay resultados encontrados
                return view('admin.clientes.gestionar_servicios');
            }
        }

        //muestra todos los clientes con servicios
        else{
             //si no esta definida la variable que muestre todos
            $clservicios = DB::table('cliente_servicio')->where('estado_pago', 1)->get();
            return view('admin.clientes.gestionar_servicios', ['clservicios' => $clservicios]);
    }
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

}
