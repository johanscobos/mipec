@extends('layouts.principal')
@section('title','Crear Servicios')
@section('content')

    <h2>Crear Servicios</h2>
    {!! Form::open(['route' => 'servicios.store', 'method' => 'post']) !!}
    @foreach($errors->all() as $error)
    <p class="alert alert-danger">{{$error}}</p>
    @endforeach
    <div class="form-group">
        {!!Form::label('servicio', 'Nombre del servicio');!!}
        {!!Form::text('nombre',null,['class' => 'form-control'], $attributes=['required']) ; !!}
    </div>

    <br>
    {!! Form::submit('Enviar',['class' => 'btn btn-primary']); !!}
    {!! Form::close() !!}
@endsection