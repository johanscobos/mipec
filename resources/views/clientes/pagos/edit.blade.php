@can('ver_editar_pagos')

@extends('layouts.principal')
@section('title','Clientes - Planillas')
@section('content')

    <h2>Editar Pago</h2>
    

    <div class="card">
        <div class="card-header">
            Referencia de pago: <b>{{$pago->referenceCode}}</b>
        </div>
        <div class="card-body">
            <h5 class="card-title">Subir planilla de pago</h5>
            {!! Form::open(['route' => ['pagos.update', $pago], 'method' => 'put', 'files' => true]) !!}

		    
		    {!! Form::file('planilla') !!}<br>
		    {!! $errors->first('planilla','<span class=error>:message</span>') !!}
		    <br>
		    {!! Form::submit('Actualizar',['class' => 'btn btn-primary']); !!}
		    {!! Form::close() !!}

        </div>
    </div>

@endsection

@endcan