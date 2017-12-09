@extends('layouts.principal')
@section('title','Clientes - Planillas')
@section('content')

    <h2>Planillas</h2>
    {!! Form::open(['route' => 'clientes.subir_planilla', 'method' => 'put', 'files' => true]) !!}

    {!! Form::label ('planilla', 'Planilla')!!}<br>
    {!! Form::file('planilla') !!}<br>
    {!! $errors->first('planilla','<span class=error>:message</span>') !!}
    <br>
    {!! Form::submit('Subir',['class' => 'btn btn-primary']); !!}
    {!! Form::close() !!}
@endsection