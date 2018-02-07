<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;


class Pago extends Model
{
    protected $fillable = [
        'valor_pago','descripcion','cliente_id','mes_id','anio_id','servicio_id','referenceCode'
    ];

    public function pagos()
    {
        return $this->hasOne('App\Pago');
    }
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function servicio()
    {
        return $this->hasOne('App\Servicio');
    }
    public function mes()
    {
        return $this->belongsTo('App\Mes');
    }
    public function anio()
    {
        return $this->belongsTo('App\Anio');
    }

    public function datoscliente(){
        return $this->belongsTo('App\Cliente','cliente_id','id');
    }

    public function datosservicio(){
        return $this->belongsTo('App\Servicio','servicio_id','id');
    }


   /* public function scopeBuscar($query,$dato){

        if(trim($dato) !=""){
            $cliente = Cliente::where('cedula', $dato)
                ->orWhere('nombre_completo','like', '%' .$dato. '%')
                ->first();

            $cliente_id=$cliente->id;

            $query->where('cliente_id',$cliente_id);


        }

    }
  */

 public function scopeBuscarallpagos($query,$dato){
        //Si $dato es diferente de "", ejecuto  la consulta
        //con "trim" elimino los espacios recibidos con $dato
        // con el método LIKE hago puedo hacer busquedas con una fracción de una palabra, ejemplo: col
       
      $cliente=Cliente::find($dato);
        if(trim($dato) !=""){
            $query->where('nombres',"LIKE","%$dato%")
            ->orWhere('apellidos',"LIKE","%$dato%")
            ->orWhere('cedula',$dato) 
            ->orWhere('referenceCode',"LIKE","%$dato%")
            ->orWhere('valor_pago', $dato)
            ->orWhere('nombre',"LIKE","%$dato%");
        }
    }

    public function scopeBuscar($query,$dato){

        if(trim($dato) !=""){
            $cliente = Cliente::where('cedula', $dato)->first();

            if($cliente!=""){
                $cliente_id=$cliente->id;

                $query->where('cliente_id',$cliente_id);

            }
            else{
                $query->where('referenceCode',$dato);
            }

        }

    }

    public function scopeBuscar_ref($query,$dato){

        if(trim($dato) !=""){
            $query->where('referenceCode',$dato);
        }

    }

    /*
    public function scopeBuscar($query,$dato){

        if(trim($dato) !=""){
            $cliente = Cliente::where('cedula', $dato)->first();

            $cliente_id=$cliente->id;

            $query->where('cliente_id',$cliente_id);
        }
    }

*/

}
