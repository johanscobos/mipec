@extends('layouts.principal')
@section('title','Realizar Pago')
@section('content')

    <h2>Formulario de pago</h2>
    {!! Form::open(['url' => 'https://sandbox.gateway.payulatam.com/ppp-web-gateway/', 'method' => 'post']) !!}

    <div class="form-group">
        {!!Form::hidden('merchantId','688911') ; !!}
        {!!Form::hidden('referenceCode','AAA1254578') ; !!}
        {!!Form::text('description') ; !!}
        {!!Form::text('descripcion_variable', ''); !!}
        {!!Form::text('amount') ; !!}
        {!!Form::hidden('tax','0'); !!}
        {!!Form::hidden('taxReturnBase','0') ; !!}
        {!!Form::hidden('signature','7ee7cf808ce6a39b17481c54f2c57acc') ; !!}
        {!!Form::hidden('accountId','691796') ; !!}
        {!!Form::hidden('currency','COP') ; !!}
        {!!Form::hidden('buyerFullName','Albert Cobos Palma') ; !!}
        {!!Form::text('buyerEmail') ; !!}
        {!!Form::hidden('shippingAddress','') ; !!}
        {!!Form::hidden('shippingCity','Pereira') ; !!}
        {!!Form::hidden('shippingCountry','57') ; !!}
        {!!Form::hidden('telephone','3204190555') ; !!}
        <br>


        {!! Form::submit('Enviar'); !!}
        {!! Form::close() !!}
    </div>

@endsection