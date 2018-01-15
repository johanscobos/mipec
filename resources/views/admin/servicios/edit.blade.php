
@extends('layouts.principal')
@section('title','Editar Servicios '.$servicio->nombre)
@section('content')



    <h2>Editar Servicio "{{$servicio->nombre}}"</h2>
    @include('flash::message')
    {!! Form::open(['route' => ['servicios.update',$servicio], 'method' => 'put']) !!}
    @foreach($errors->all() as $error)
        <p class="alert alert-danger">{{$error}}</p>
    @endforeach
    <div class="form-group">
        {!!Form::label('servicio', 'Nombre del servicio');!!}
        {!!Form::text('nombre',$servicio->nombre,['class' => 'form-control'], $attributes=['required']) ; !!}

        {!!Form::label('descripcion', 'Descripción');!!}
        {!!Form::text('descripcion',$servicio->descripcion,['class' => 'form-control'], $attributes=['required']) ; !!}
    </div>

    <br>
    {!! Form::submit('Editar',['class' => 'btn btn-primary']); !!}
    {!! Form::close() !!}


@endsection

 