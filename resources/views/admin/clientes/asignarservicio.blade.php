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


    <br>
    {!! Form::submit('Enviar',['class' => 'btn btn-primary']); !!}
    {!! Form::close() !!}
@endsection