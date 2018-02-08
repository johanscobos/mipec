@php
use App\Cliente;
use App\Pago;
use App\Servicio;
@endphp
@extends('layouts.principal')
@section('title','Pagos - Detalles')
@section('content')

    <h2>Detalles Pago</h2>

    <div class="card">
        <div class="card-header">
            Referencia de pago: <b>{{$pago->referenceCode}}</b>
        </div>
        <div class="card-body">
            <h5 class="card-title">Fecha de pago</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <h5 class="card-title">Valor pagado:</h5>
            <p class="card-text">$ {{$pago->valor_pago}}</p>
            <h5 class="card-title">Cliente</h5>
            <p class="card-text">
                @php               
                $cliente = Pago::find($pago->id)->cliente;
                echo $cliente->nombres.' '.$cliente->apellidos;
                @endphp
            </p>
            <h5 class="card-title">Servicio</h5>
            <p class="card-text">
                @php               
                $servicio = Servicio::find($pago->servicio_id);
                echo $servicio->nombre;
                @endphp
            </p>
            <h5 class="card-title">Descripción</h5>
            <p class="card-text">
                @php               
                $descripcion = Servicio::find($pago->servicio_id);
                echo $descripcion->descripcion;
                @endphp
            </p>
            <h5 class="card-title">Planilla</h5>
            <p class="card-text"><a href="{{$pago->planilla}}">
                 <a href="{{$pago->planilla}}" class="btn btn-warning" title="Descargar">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            </p>


        </div>
    </div>

@endsection