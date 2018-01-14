@php
    use App\Cliente;
    use App\Servicio;
    use Illuminate\Support\Facades\Auth;
@endphp
@extends('layouts.principal')
@section('title','Clientes - Servicios pendientes de pago')
@section('content')

    <h2>prueba</h2>

    {!! Form::open(['url' => 'http://app.mipensionencolombia.com/clientes/pagos/confirmar_pago', 'method' => 'post']) !!}

    {!! Form::label('state_pol','Estado de pago') ; !!}
    {!! Form::text('state_pol') ; !!}
    {!! Form::label('reference_sale','Reference Saless') ; !!}
    {!! Form::text('reference_sale') ; !!}


    {!! Form::submit('Pagar',['class' => 'btn btn-danger']); !!}

    {!! Form::close() !!}

@endsection