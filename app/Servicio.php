<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicios';
    protected $fillable = [
        'nombre','descripcion'
    ];

    public function pago()
    {
        return $this->belongsTo('App\Pago');
    }

    public function clientes()
    {
        return $this->belongsToMany('App\Cliente')->withPivot('valor_pagar', 'estado_pago','estado_servicio','descripcion_variable');
    }


     public function scopeBuscar($query,$dato){
        //Si $dato es diferente de "", ejecuto  la consulta
        //con "trim" elimino los espacios recibidos con $dato
        // con el método LIKE hago puedo hacer busquedas con una fracción de una palabra, ejemplo: col
        if(trim($dato) !=""){
            $query->where('nombre',"LIKE","%$dato%");
        }
    }
}

