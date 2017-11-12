@extends('layouts.principal')
@section('title','Crear Pago')
@section('content')

    <h2>Crear pago</h2>
    {!! Form::open(['route' => 'pagos.store', 'method' => 'post']) !!}

    <div class="form-group fondo">
        {!!Form::label('valor_pago', 'Valor a pagar');!!}
        {!!Form::text('valor_pago',null,['class' => 'form-control'], $attributes=['required']) ; !!}
    </div>


    <br>
    {!! Form::submit('Enviar'); !!}
    {!! Form::close() !!}
@endsection