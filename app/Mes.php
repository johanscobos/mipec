<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mes extends Model
{
    protected $fillable = [
        'nombre',
    ];

    public function pagos()
    {
        return $this->hasMany('App\Pagos');
    }
}
