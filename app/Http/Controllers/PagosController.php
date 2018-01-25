<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
       $pagos = Pago::buscarallpagos($request->get('dato'))
       ->join('clientes', 'pagos.cliente_id', '=', 'clientes.id')
       ->get();
     
      $count=0;
      foreach ($pagos as $pago) {
          $count=1;
      }
        // si la busquedad no arroja resultados
       if($count==0){      
        $pagos = Pago::join('clientes', 'pagos.cliente_id', '=', 'clientes.id')->get();
        flash('No se encuentran registros asociados a la búsqueda !!')->success(); 
        return view('admin.pagos.index')->with('pagos',$pagos);
       }     
       
       return view('admin.pagos.index')->with('pagos',$pagos);
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

    public function confirmar_pago(Request $request){

        $state_pol = $request->input("state_pol");
        $reference_sale = $request->input("reference_sale");
        $response_message_pol = $request->input("response_message_pol");
        $response_code_pol = $request->input("response_code_pol");

        if($state_pol=='4')
        {
            $aprobado=1;

        //$cliente=Cliente::where('cedula', '100000000')->get();
        $cliente=Cliente::find(2);
        $cliente->telefono='3430699';
        $cliente->save();
        dd("ok");
        }

        else{
            dd("diferente de la opción 4");
        }

        $aprobado=1;

        //$cliente=Cliente::where('cedula', '100000000')->get();
       /* $cliente=Cliente::find(2);
        $cliente->telefono='3430622';
        $cliente->save();
        dd("ok");
*/

        //$clservicios = DB::table('cliente_servicio')->where([['referenceCode', '=', 'MIPEC23']])->update(['estado_pago' => $aprobado]);;

        /*if($state_pol=='4'){

            $clservicios = DB::table('cliente_servicio')->where([['referenceCode', '=', $reference_sale]])->update(['estado_pago' => $aprobado]);;
            //dd($clservicios);
            //$clservicios->estado_pago=$aprobado;
            //$clservicios->save();


            //dd("La transaccion fue exitosa");


        }*/


        /*if($state_pol==1){
            //dd("Hola desde confirmar pago");

            //$cliente=Cliente::where('cedula', '100000000')->get();
            $cliente=Cliente::find(2);
            $cliente->telefono='3430650';
            $cliente->save();
dd('ok');

        }*/
        /*else{
            //dd("La transaccion no se realizó exitosamente");
        }*/
}

public function respuesta_pago($txt_value){
        //dd("Hola desde respuesta de formulario");
        //dd($request->input("merchantId"));
        //$txt_value=$request->input("tx_value", 100);
   //dd($name = $request->input('dato'));
    //dd($uri = $request->path());


/*
    if ($request->has("dato")){
        echo "Encontré el numero";
    }
    else{
        echo "No se encontró el numero";
    }*/
    $valor_formateado = number_format($txt_value, 2, '.', '');
  //  dd($new_value = number_format($txt_value, 2, '.', ''));
$porcion=explode(".",$valor_formateado);
//dd($decimal=$porcion[1]);
   $decimal=$porcion[1];




/*if($decimal[0]==0){
    dd("es correcto");
}
else if($decimal[0]==1){
    dd("es igual a 1");
}*/
//Si el primer decimal es par y el segundo es 5, se redondeará hacia el menor valor.
    if ($decimal[0]%2==0){
        //"el primer decimal es par";
        if($decimal[1]==5){
            //el segundo decimal es 5
            //dd("se redondeará hacia el menor valor");
            //dd(round($valor_formateado, 1, PHP_ROUND_HALF_DOWN));
            $new_value= round($valor_formateado, 1, PHP_ROUND_HALF_DOWN);
        }
        else{
           // "el segundo decimal es diferente de 5";
            //dd("En cualquier otro caso se redondeará al decimal más cercano");
            //dd(round($valor_formateado, 1));
            $new_value=round($valor_formateado, 1);
        }
    }else{
        //el primer decimal es impar
        if($decimal[1]==5){
            //el segundo decimal es 5
            //dd(" se redondeará hacia el valor mayor");
            //dd(round($valor_formateado, 1, PHP_ROUND_HALF_UP));
            $new_value=round($valor_formateado, 1, PHP_ROUND_HALF_UP);

        }
        else{
            //el segundo decimal es diferente de 5

            //dd("En cualquier otro caso se redondeará al decimal más cercano");
            //dd(round($valor_formateado, 1));
            $new_value=round($valor_formateado, 1);
        }

    }

    //datos para generar la new_firma
    $apikey="K4mvTeqzoeATzM5F72DVP3O8VO";
    $merchantId="688911";
    $currency="COP";
    $referenceCode=27;
    $transactionState=6;
    $signature="03fbd98384fe2dc0bb8911c7ab215734";

//para trabajar con datos reales, aca debo remmplazar por los datos enviados en el objeto http con el metodo $request
    $cadena_new_signature=$apikey.'~'.$merchantId.'~'.$referenceCode.'~'.$new_value.'~'.$currency.'~'.$transactionState;
    dd($new_signature=md5($cadena_new_signature));

    //hacer un select a la tabla clientes_servicios donde el referenceCode=$refenceCode
/*
    $clservicios = DB::table('cliente_servicio')->where([
        ['referenceCode', '=', $referenceCode]
    ])->get();
//dd($clservicios);
    $signature_db=$clservicios->signature;
*/

if($signature==$new_signature){
   //dd("las firmas coinciden");
}


/*if(is_float ( $new_value )){
dd("es float");
}
else{
    dd("no es float");
}*/

    //$new_value= numero_decimal;
    $partes = explode(".",$new_value);
   /* if ($new_value[1] == 0) {
        dd("Es entero");
    }

    dd($new_value = number_format($txt_value, 2, '.', ''));
    //dd($tdato);*/
    //return "el dato es: {$dato}";
}
}
