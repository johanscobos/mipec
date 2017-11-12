<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anio extends Model
{
    protected $fillable = [
        'nombre', 'estado', 'pais_codigo',
    ];
    public function pagos()
    {
        return $this->hasMany('App\Pagos');
    }
}
