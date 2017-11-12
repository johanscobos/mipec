<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = [
        'valor_pago','descripcion','cliente_id','mes_id','anio_id','servicio_id'
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

}
