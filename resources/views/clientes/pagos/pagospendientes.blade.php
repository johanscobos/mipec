@php
    use App\Cliente;
    use App\Servicio;
    use Illuminate\Support\Facades\Auth;
@endphp
@extends('layouts.principal')
@section('title','Clientes - Servicios pendientes de pago')
@section('content')

    <h2>Mis Servicios por pagar</h2>

    @php
       $email = Auth::user()->email;
      @endphp

    @if(count($pagospendientes)==0)
        <h3>A la fecha, no tiene pagos pendietes</h3>
    @else
        <table class="table">
        <thead>
        <tr>
            <th scope="col">Servicio</th>
            <th scope="col">Ref. Unica</th>
            <th scope="col">Valor $</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pagospendientes as $pp)

                @php
                    //Instancio el servicio con el id
                     $servicio = App\Servicio::find($pp->servicio_id);

                    //Instancio el cliente con el id
                     $cliente = App\Cliente::find($pp->cliente_id);
                @endphp
            <tr>
                <td>
                    @php
                      echo $servicio->nombre;
                    @endphp
                </td>
                <td>
                    @php
                        echo $pp->referenceCode;
                    @endphp
                </td>
                <td>
                    @php
                        echo $pp->valor_pagar;
                    @endphp
                </td>
                <td>
                    @php
                        echo $descripcion=$servicio->descripcion.'. '.$pp->descripcion_variable;
                    $apikey="K4mvTeqzoeATzM5F72DVP3O8VO";
                    $merchantId="688911";
                    $reference=$pp->referenceCode;
                   // dd($reference);
                    $amount=$pp->valor_pagar;
                    $moneda="COP";

                    $dat=$apikey.'~'.$merchantId.'~'.$reference.'~'.$amount.'~'.$moneda;
                    //dd($dat);
                    //$firm=hash('md5', $dat);
                     $sign=md5($dat);
                    // dd($firm);




                    @endphp
                </td>
                <td>
                {!! Form::open(['url' => 'https://gateway.payulatam.com/ppp-web-gateway/', 'method' => 'post']) !!}


                {!! Form::hidden('merchantId','688911') ; !!}
                {!! Form::hidden('ApiKey','K4mvTeqzoeATzM5F72DVP3O8VO') ; !!}
                {!! Form::hidden('referenceCode',$pp->referenceCode) ; !!}
                {!! Form::hidden('description',$servicio->descripcion) !!}
                {!! Form::hidden('amount',$pp->valor_pagar) !!}
                {!! Form::hidden('tax','0'); !!}
                {!! Form::hidden('taxReturnBase','0') ; !!}
                {!! Form::hidden('signature',$sign) ; !!}
                {!! Form::hidden('accountId','691796') ; !!}
                {!! Form::hidden('currency','COP') !!}<!-- COL -->
                    {!! Form::hidden('buyerFullName',$cliente->nombres) !!}
                    {!! Form::hidden('buyerEmail',$email) !!}
                    {!! Form::hidden('shippingAddress',$cliente->direccion) !!}
                    {!! Form::hidden('shippingCity',$cliente->ciudad_id) !!}
                    {!! Form::hidden('shippingCountry','57') !!}
                    {!! Form::hidden('telephone',$cliente->celular) !!}
                    {!! Form::hidden('confirmationUrl','http://www.mipensionencolombia.com/confirmation') !!}




                    {!! Form::submit('Pagar',['class' => 'btn btn-danger']); !!}

                    {!! Form::close() !!}





                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

@endsection