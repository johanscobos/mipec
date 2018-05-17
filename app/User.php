<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','tipo_user','tipo_rol'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cliente()
    {
        return $this->hasOne('App\Cliente');
    }

    public function empleado()
    {
        return $this->hasOne('App\Empleado');
    }

    public function scopeBuscar($query,$dato){
        //Si $dato es diferente de "", ejecuto  la consulta
        //con "trim" elimino los espacios recibidos con $dato
        // con el método LIKE hago puedo hacer busquedas con una fracción de una palabra, ejemplo: col
        if(trim($dato) !=""){
            $query->where('username',"LIKE","%$dato%");
        }
    }

    public function scopeBuscaruser($query,$dato){
        //Si $dato es diferente de "", ejecuto  la consulta
        //con "trim" elimino los espacios recibidos con $dato
        // con el método LIKE hago puedo hacer busquedas con una fracción de una palabra, ejemplo: col

        $users=User::find($dato);
        if(trim($dato) !=""){

            $query->where('empleados.nombres',"LIKE","%$dato%")
                ->orWhere('empleados.apellidos',"LIKE","%$dato%")
                ->orWhere('empleados.cedula',$dato)
                ->orWhere('clientes.nombres',"LIKE","%$dato%")
                ->orWhere('clientes.apellidos',"LIKE","%$dato%")
                ->orWhere('clientes.cedula',$dato);
        }

    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }


}
