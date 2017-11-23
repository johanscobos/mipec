@php
    use App\Cliente;
    use App\Servicio;
    use Illuminate\Support\Facades\Auth;
@endphp

@extends('layouts.principal')
@section('title','Clientes - Gestionar clientes')
@section('content')

    <h1>Gestionar Cliente</h1>


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
                    {!! Form::open(['route' => 'clientes.activarcliente', 'method' => 'post']) !!}
                    @if($estado_servicio_actual==0)

                    {!! Form::submit('Activar',['class' => 'btn btn-primary']); !!}
                        {!! Form::hidden('cliente_id',$cliente_id )!!}
                        {!! Form::hidden('rc',$rc )!!}
                        {!! Form::hidden('accion','1' )!!}
                    @else
                        {!! Form::submit('Inactivar',['class' => 'btn btn-danger']); !!}
                        {!! Form::hidden('id',$cliente_id )!!}
                        {!! Form::hidden('rc',$rc )!!}
                        {!! Form::hidden('accion','0' )!!}
                    @endif
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection