@extends('layouts.principal')
@section('title','Clientes - Asignar Servicios')
@section('content')


    <h2>Asignar Servicios</h2>
    {!! Form::open(['route' => 'clientes.store', 'method' => 'post']) !!}
    @foreach($errors->all() as $error)
        <p class="alert alert-danger">{{$error}}</p>
    @endforeach
    <div class="form-group">
        {!!Form::label('clientes', 'Nombre del cliente');!!}
        {!! Form::select('cliente_id',$clientes, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!!Form::label('servicios', 'Nombre del Servicio');!!}
        {!! Form::select('servicio_id',$servicios, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!!Form::label('valor_pagar', 'Valor del servicio');!!}
        {!! Form::number('valor_pagar',null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!!Form::label('descripcion_variable', 'Descripcion variable');!!}
        {!! Form::text('descripcion_variable',null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!!Form::label('estado_pago', 'Estado de Pago');!!}
        {!! Form::select('estado_pago', ['0' => 'Inactivo', '1' => 'Activo'], ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!!Form::label('estado_servicios', 'Estado Servicio');!!}
        {!! Form::select('estado_pago', ['0' => 'Inactivo', '1' => 'Activo'], ['class' => 'form-control']) !!}
    </div>

    <br>
    {!! Form::submit('Enviar',['class' => 'btn btn-primary']); !!}
    {!! Form::close() !!}
@endsection