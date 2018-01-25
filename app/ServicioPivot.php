<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
//use App\Servicio;

class ServicioPivot extends Pivot
{
	protected $table = 'cliente_servicio';
/*
    protected $fillable = [
        'cedula', 'nombres', 'apellidos','telefono','celular','direccion','pais_codigo','ciudad_id','empleado_id','user_id','estado'
    ];
*/
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }



}