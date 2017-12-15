@php
    use App\User;
@endphp

@extends('layouts.principal')
@section('title','Clientes - Mi historial de pagos')
@section('content')

    <h1>Mi historial de pagos</h1>
    @include('flash::message')
    <nav class="navbar navbar-light bg-light">
        {!! Form::open(['method' => 'get', 'class'=>'form-inline','role'=>'search']) !!}
        <div class="form-group">
            {!! Form::text('dato',null,['class' => 'form-control mr-sm-2', 'placeholder' => 'Ref. Pago'] )!!}
            <div class="form-group">
        {!! Form::submit('Buscar',['class' => 'btn btn-outline-success my-2 my-sm-0']); !!}

        {!! Form::close() !!}
    </nav>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Servicio</th>
            <th scope="col">Referencia de Pago</th>
            <th scope="col">Valor pagado</th>
            <th scope="col">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pagos as $pago)
            <tr>
                <th scope="row">{{$pago->id}}</th>
                <td>{{$pago->datosservicio->nombre}}</td>
                <td>{{$pago->referenceCode}}</td>
                <td>{{'$ '.$pago->valor_pago}}</td>

                @if($pago->datosservicio->id ==1)
                    <td><a href="{{route('clientes.pagos.bajar_planilla',$pago->id)}}" class="btn btn-danger">D. Planilla</a> <a href="" class="btn btn-warning">Detalles</a></td>
                       @endif

            </tr>
        @endforeach
        </tbody>
    </table>

@endsection