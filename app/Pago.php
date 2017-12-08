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


   /* public function scopeBuscar($query,$cedula){

        if(trim($cedula) !=""){
            $cliente = Cliente::where('cedula', $cedula)
                ->orWhere('nombre_completo','like', '%' .$cedula. '%')
                ->first();

            $cliente_id=$cliente->id;

            $query->where('cliente_id',$cliente_id);


        }

    }
   */

    public function scopeBuscar($query,$cedula){

        if(trim($cedula) !=""){
            $cliente = Cliente::where('cedula', $cedula)->first();

            $cliente_id=$cliente->id;

            $query->where('cliente_id',$cliente_id);
        }
    }



}
