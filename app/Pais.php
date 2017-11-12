<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $fillable = [
        'nombre'
    ];

    public function ciudades()
    {
        return $this->hasMany('App\Ciudad');
    }

    public function empleados()
    {
        return $this->hasMany('App\Empleado');
    }

    public function clientes()
    {
        return $this->hasMany('App\Cliente');
    }
}
