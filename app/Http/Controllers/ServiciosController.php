<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Servicio;
use App\Cliente;
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

        $count=0;
      foreach ($servicios as $servicio) {
          $count=1;
      }
        // si la busquedad no arroja resultados
       if($count==0){ 
        flash('No se encuentran registros asociados a los parámetros de busqueda.!!.')->success();
        return view('admin.servicios.index')->with('servicios',$servicios);
       }
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

        flash('El servicio se creó satisfactoriamente.!!.')->success();
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

    public function serviciosporpagarBueno(Request $request){
      
        $dato = $request->dato;
        //dd($dato);
         
         if (!empty($dato))
        {
           // Obtengo los datos del cliente, según el dato enviado desde la busqueda de la vista  
             $query->where('nombre',"LIKE","%$dato%");

             $cliente  = Cliente::where('nombres', 'LIKE', '%'.$dato.'%')
            ->orWhere('apellidos', 'LIKE', '%'.$dato.'%')
            ->orWhere('cedula', $dato)->get();

            if($cliente!=NULL)
            {
                
                //Obtengo el id del objeto obtenido en el query
                $cliente_id = $cliente->id;

                //Busco los clientes que coincidan con el id
                $serviciosporpagar = DB::table('cliente_servicio')->where([
                    ['cliente_id', '=', $cliente_id],
                    ['estado_pago', '=', 0],
                ])->get();

                // envio la coleccion de objetos
                return view('admin.servicios.serviciosporpagar', ['serviciosporpagar' => $serviciosporpagar]);
            }
            else{
                
                // Si el query no arroja resultados, que muestre el mensaje de error y todos los clientes con servicios
                flash('No hay clientes asociados con los datos suministrados!!.')->success();
                $serviciosporpagar = DB::table('cliente_servicio')->where('estado_pago', 1)->get();
            return view('admin.servicios.serviciosporpagar', ['serviciosporpagar' => $serviciosporpagar]);
            }
         }
         else{
                 $serviciosporpagar = DB::table('cliente_servicio')->where([['estado_pago', '=', '0'],])->get();
                 return view('admin.servicios.serviciosporpagar', ['serviciosporpagar' => $serviciosporpagar]);  
         }

    }


    public function serviciosporpagar(Request $request){
      
         //$datos= Cliente::buscarpagos($request->get('dato'))->orderBy('id','ASC')->paginate(10);

        $serviciosporpagar = Cliente::buscarpagospendientes($request->get('dato'))
       ->join('cliente_servicio', 'cliente_servicio.cliente_id', '=', 'clientes.id')
       ->join('servicios', 'cliente_servicio.servicio_id', '=', 'servicios.id')
       ->select('clientes.id', 'clientes.nombres', 'clientes.apellidos','clientes.cedula','cliente_servicio.servicio_id','cliente_servicio.cliente_id','cliente_servicio.referenceCode','cliente_servicio.valor_pagar','cliente_servicio.estado_pago','servicios.id','servicios.nombre','servicios.descripcion')
       ->where('cliente_servicio.estado_pago','=',0)
       ->get();


        $count=0;
      foreach ($serviciosporpagar as $sporpagar) {
          $count=1;
      }
        // si la busquedad no arroja resultados
       if($count==0){      
        $serviciosporpagar = Cliente::
       join('cliente_servicio', 'cliente_servicio.cliente_id', '=', 'clientes.id')
       ->join('servicios', 'cliente_servicio.servicio_id', '=', 'servicios.id')
       ->select('clientes.id', 'clientes.nombres', 'clientes.apellidos','clientes.cedula','cliente_servicio.servicio_id','cliente_servicio.cliente_id','cliente_servicio.referenceCode','cliente_servicio.valor_pagar','cliente_servicio.estado_pago','servicios.id','servicios.nombre','servicios.descripcion')
       ->where('cliente_servicio.estado_pago','=',0)
       ->get();

        flash('No se encuentran registros asociados a la búsqueda !!')->success(); 
        return view('admin.servicios.serviciosporpagar')->with('serviciosporpagar',$serviciosporpagar);
       }  

        //dd($serviciosporpagar);
        return view('admin.servicios.serviciosporpagar')->with('serviciosporpagar',$serviciosporpagar);       

    }



}



