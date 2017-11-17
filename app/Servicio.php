<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
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
}
