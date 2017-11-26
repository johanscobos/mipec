@extends('layouts.principal')
@section('title','Realizar Pago')
@section('content')

    <h2>Formulario de pago</h2>
    {!! Form::open(['url' => 'https://sandbox.gateway.payulatam.com/ppp-web-gateway/', 'method' => 'post']) !!}

    <div class="form-group">
        {!!Form::hidden('merchantId') ; !!}
        {!!Form::hidden('referenceCode') ; !!}
        {!!Form::text('description') ; !!}
        {!!Form::text('descripcion_variable'); !!}
        {!!Form::text('amount') ; !!}
        {!!Form::hidden('tax'); !!}
        {!!Form::hidden('taxReturnBase') ; !!}
        {!!Form::hidden('signature') ; !!}
        {!!Form::hidden('accountId') ; !!}
        {!!Form::hidden('currency') ; !!}
        {!!Form::hidden('buyerFullName') ; !!}
        {!!Form::text('buyerEmail') ; !!}
        {!!Form::hidden('shippingAddress','') ; !!}
        {!!Form::hidden('shippingCity') ; !!}
        {!!Form::hidden('shippingCountry') ; !!}
        {!!Form::hidden('telephone') ; !!}
        <br>


        {!! Form::submit('Enviar'); !!}
        {!! Form::close() !!}
    </div>

@endsection