  <?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $fillable = [
        'nombre','estado','pais_codigo'
    ];
    protected $table = 'ciudades';

    public function pais()
    {
        return $this->belongsTo('App\Pais');
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
