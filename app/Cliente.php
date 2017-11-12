<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'cedula', 'nombres', 'apellido1','apellido2','telefono','celular','direccion','pais_codigo','ciudad_id','empleado_id','user_id','estado'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pagos()
    {
        return $this->hasMany('App\Pago');
    }

    public function empleado()
    {
        return $this->belongsTo('App\Empleado');
    }

    public function servicios()
    {
        return $this->belongsToMany('App\Servicio');
    }

    public function pais()
    {
        return $this->belongsTo('App\Pais');
    }
    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad');
    }
}
