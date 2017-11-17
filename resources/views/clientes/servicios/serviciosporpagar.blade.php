@php
use App\Cliente;
use App\Servicio;
use Illuminate\Support\Facades\Auth;
@endphp
@extends('layouts.principal')
@section('title','Clientes - Servicios pendientes de pago')
@section('content')

    <h2>Servicios por pagar</h2>

    @php
        $user = Auth::user();

    @endphp

    @php

        $user_id = Auth::user()->id;
        $cliente = Cliente::find($user_id);
        $descripcion=$cliente->descripcion;
    //dd($user_id);
    @endphp


    <table class="table">
        <thead>
        <tr>
            <th scope="col">Id Servicio</th>
            <th scope="col">Valor $</th>

            <th scope="col">Descripcion</th>
            <th scope="col">Pagar</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cliente->servicios as $servicio)

        <tr>
            <td>
                @php
               echo $servicio->pivot->servicio_id;
                @endphp
            </td>

            <td>
                @php
                    echo $servicio->pivot->valor_pagar;
                @endphp
            </td>
            <td>
                @php
                    echo $servicio->descripcion;
                @endphp
            </td>
            <td>
                <!-- se enlaza con el formulario de pago-, debe ser por POST-->
                {!! Form::open(['route' => 'clientes.formupago', 'method' => 'post']) !!}

                {!! Form::hidden('servicio_id',$servicio->pivot->servicio_id) !!}
                {!! Form::hidden('valor_pagar',$servicio->pivot->valor_pagar) !!}
                {!! Form::hidden('descripcion_variable',$servicio->pivot->descripcion_variable) !!}
                {!! Form::hidden('descripcion',$servicio->descripcion) !!}

                {!! Form::submit('Pagar',['class' => 'btn btn-danger']); !!}
                {!! Form::close() !!}


            </td>


        </tr>
       @endforeach
        </tbody>
    </table>

@endsection