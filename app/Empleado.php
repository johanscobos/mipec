<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'cedula', 'nombres', 'apellido1','apellido2','telefono','celular','direccion','pais_codigo','ciudad_id','user_id','estado'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function clientes()
    {
        return $this->hasMany('App\Cliente');
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
