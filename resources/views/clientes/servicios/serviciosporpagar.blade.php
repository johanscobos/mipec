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
        $email = Auth::user()->email;
        $user_id = Auth::user()->id;
        $cliente = Cliente::find(3);
    //dd($user);
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
        @foreach($cliente->servicios as $cli)

        <tr>
            <td>
                @php
               echo $cli->pivot->servicio_id;
                @endphp
            </td>

            <td>
                @php
                    echo $cli->pivot->valor_pagar;
                @endphp
            </td>
            <td>
                @php
                    echo $cli->descripcion;
                @endphp
            </td>
            <td>
                <!-- se enlaza con el formulario de pago-, debe ser por POST-->
                {!! Form::open(['route' => 'clientes.formupago', 'method' => 'post']) !!}

                {!! Form::hidden('servicio_id',$cli->pivot->servicio_id) !!}
                {!! Form::hidden('amount',$cli->pivot->valor_pagar) !!}
                {!! Form::hidden('descripcion_variable',$cli->pivot->descripcion_variable) !!}
                {!! Form::hidden('description',$cli->descripcion) !!}
                {!! Form::hidden('currency',$cli->descripcion) !!}
                {!! Form::hidden('buyerFullName',$cli->descripcion) !!}
                {!! Form::hidden('buyerEmail',$email) !!}
                {!! Form::hidden('shippingAddress',$cli->direccion) !!}
                {!! Form::hidden('shippingCity',$cli->descripcion) !!}
                {!! Form::hidden('shippingCity',$cli->descripcion) !!}
                {!! Form::hidden('shippingCountry',$cli->descripcion) !!}
                {!! Form::hidden('telephone',$cli->descripcion) !!}

                {!! Form::submit('Pagar',['class' => 'btn btn-danger']); !!}
                {!! Form::close() !!}


            </td>


        </tr>
       @endforeach
        </tbody>
    </table>

@endsection