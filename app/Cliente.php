<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Servicio;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'cedula', 'nombres', 'apellidos','telefono','celular','direccion','pais_codigo','ciudad_id','empleado_id','user_id','estado'
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
        /*:::::::original::::::::::::::::::::::::::::::::::::::
        return $this->belongsToMany('App\Servicio')
            ->withPivot('valor_pagar', 'estado_pago','estado_servicio','descripcion_variable');*/
            return $this->belongsToMany(Servicio::class)
            ->withPivot('valor_pagar', 'estado_pago','estado_servicio','descripcion_variable');
    }

    public function servicioss()
    {
        /*:::::::original::::::::::::::::::::::::::::::::::::::
        return $this->belongsToMany('App\Servicio')
            ->withPivot('valor_pagar', 'estado_pago','estado_servicio','descripcion_variable');*/
            return $this->belongsToMany(Servicio::class)
            ->withPivot('referenceCode','valor_pagar', 'estado_pago','estado_servicio','descripcion_variable')
            ->wherePivot('estado_pago', 0);
    }


    public function pais()
    {
        return $this->belongsTo('App\Pais');
    }
    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad');
    }



    public function scopeBuscar($query, $cedula){

        //$roles = User::find($name)->roles;

       /* return $query->where('nombres', 'LIKE', '%' .$dato. '%')
            ->orWhere->('apellido1', 'LIKE', '%' .$dato. '%')
            ->orWhere->('cedula', '$dato');*/

       $query->where('cedula','$cedula');

    }

    public function scopeBuscarpagospendientes($query,$dato){
        //Si $dato es diferente de "", ejecuto  la consulta
        //con "trim" elimino los espacios recibidos con $dato
        // con el método LIKE hago puedo hacer busquedas con una fracción de una palabra, ejemplo: col
       
      $cliente=Cliente::find($dato);
        if(trim($dato) !=""){
           
          /* if($dato=='0'){
           dd($dato);
           }
           else{*/
             $query->where('nombres',"LIKE","%$dato%")
            ->orWhere('apellidos',"LIKE","%$dato%")
            ->orWhere('cedula',$dato) 
            ->orWhere('referenceCode',"LIKE","%$dato%")    
            ->orWhere('nombre',"LIKE","%$dato%"); 
          // }
         }

    }




}
