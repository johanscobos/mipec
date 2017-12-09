@php
    use App\Cliente;
    use App\Servicio;
    use Illuminate\Support\Facades\Auth;
@endphp

@extends('layouts.principal')
@section('title','Clientes - Gestionar Servicios')
@section('content')

    <h1>Activar / Inactivar Servicio</h1>

    {!! Form::open(['route' => 'clientes.gestionar_servicios', 'method' => 'get']) !!}

        {!! Form::label('cedula','Ingrese cédula del cliente' )!!}
        {!! Form::text('cedula' )!!}
        {!! Form::submit('Buscar',['class' => 'btn btn-primary']); !!}
        {!! Form::submit('Eliminar filtro',['class' => 'btn btn-primary']); !!}

    {!! Form::close() !!}

    @if(isset($clservicios))
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Cliente</th>
            <th scope="col">Cédula</th>
            <th scope="col">Ref.</th>
            <th scope="col">Servicio</th>
            <th scope="col">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clservicios as $clservicios)

            <tr>
                <td>
                    @php
                        $cliente_id=$clservicios->cliente_id;
                        $servicio_id=$clservicios->servicio_id;
                        $rc=$clservicios->referenceCode;
                        $estado_servicio_actual=$clservicios->estado_servicio;
                        $cliente = App\Cliente::find($cliente_id);
                        echo $cliente->nombres.' '.$cliente->apellido1.' '.$cliente->apellido2;
                    @endphp
                </td>
                <td>
                    @php
                        echo $cliente->cedula;
                    @endphp
                </td>
                <td>
                    @php
                        echo $clservicios->referenceCode;
                    @endphp
                </td>

                <td>
                    @php
                        $servicio_id=$clservicios->servicio_id;
                        $servicio = App\Servicio::find($servicio_id);
                        echo $servicio->nombre;
                    @endphp
                </td>
                <td>

                    @if($estado_servicio_actual==0)



                        {!! Form::open(['route' => 'clientes.activar_inactivar_servicio', 'method' => 'post']) !!}
                        {!! Form::submit('Activar',['class' => 'btn btn-primary']); !!}
                        {!! Form::hidden('cliente_id',$cliente_id )!!}
                        {!! Form::hidden('rc',$rc )!!}
                        {!! Form::hidden('accion','1' )!!}
                        {!! Form::close() !!}


                    @else
                        {!! Form::open(['route' => 'clientes.activar_inactivar_servicio', 'method' => 'post']) !!}
                        {!! Form::submit('Inactivar',['class' => 'btn btn-danger']); !!}
                        {!! Form::hidden('cliente_id',$cliente_id )!!}
                        {!! Form::hidden('rc',$rc )!!}
                        {!! Form::hidden('accion','0' )!!}
                        {!! Form::close() !!}
                        @endif



                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @else
        <b>NO hay servicios asociados para clientes con este documento!!</b>
    @endif
@endsection