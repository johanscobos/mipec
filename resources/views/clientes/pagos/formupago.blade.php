@extends('layouts.principal')
@section('title','Realizar Pago')
@section('content')

    <h2>Formulario de pago</h2>
    {!! Form::open(['url' => 'https://sandbox.gateway.payulatam.com/ppp-web-gateway/', 'method' => 'post']) !!}

    <div class="form-group">
        {!!Form::hidden('merchantId','508029') ; !!}
        {!!Form::hidden('referenceCode','AAA1254578') ; !!}
        {!!Form::hidden('description','producto1') ; !!}
        {!!Form::text('descripcion_variable',$descripcion_variable); !!}
        {!!Form::label('valor_pago', 'Valor a pagar');!!}
        {!!Form::text('amount',$vpagar) ; !!}
        {!!Form::hidden('tax','0'); !!}
        {!!Form::hidden('taxReturnBase','0') ; !!}
        {!!Form::hidden('signature','7ee7cf808ce6a39b17481c54f2c57acc') ; !!}
        {!!Form::hidden('accountId','512322') ; !!}
        {!!Form::hidden('currency','COP') ; !!}
        {!!Form::hidden('buyerFullName','Albert Cobos Palma') ; !!}
        {!!Form::hidden('buyerEmail','albertcobos@gmail.com') ; !!}
        {!!Form::hidden('shippingAddress','') ; !!}
        {!!Form::hidden('shippingCity','Pereira') ; !!}
        {!!Form::hidden('shippingCountry','57') ; !!}
        {!!Form::hidden('telephone','3204190555') ; !!}

        <br>
        {!! Form::submit('Enviar'); !!}
        {!! Form::close() !!}
    </div>

@endsection