@php
use App\Cliente;
use App\Pago;
use App\Servicio;
@endphp
@extends('layouts.principal')
@section('title','Pagos - Detalles')
@section('content')

<div class="container">
    <div class="row mix-top">
        <div class="col-12">
            <h1>Detalles Pago Pendiente</h1>
            @include('flash::message')
        </div>
    </div>
<div class="row">
  <div class="row cabez-table">
  <div class="col-12">
      
         <table class="table">
        <thead class="thead-dark bg-table">
        <tr>    
            <th scope="col">Referencia de pago</th>
            <td>{{$pago->referenceCode}}</td>            
        </tr>

        <tr>    
            <th scope="col">Fecha de pago</th>
            <td></td>            
        </tr>
        <tr>
            <th scope="col">Valor pagado</th>
            <td>
                $
                 @php
                    echo $vpago=number_format($pago->valor_pago);
                 @endphp   
            </td>            
        </tr>
        <tr>
            <th scope="col">Cliente</th>
            <td> 
                @php               
                $cliente = Pago::find($pago->id)->cliente;
                echo $cliente->nombres.' '.$cliente->apellidos;
                @endphp
            </td>           
        </tr>
        <tr>
            <th scope="col">Servicio</th>  
            <td>
            @php               
                $servicio = Servicio::find($pago->servicio_id);
                echo $servicio->nombre;
             @endphp
            </td>             
        </tr>
        <tr>
            <th scope="col">Descripción</th> 
            <td>
                @php               
                $descripcion = Servicio::find($pago->servicio_id);
                echo $descripcion->descripcion;
                @endphp
            </td>
        </tr>
        {{-- ::::: Si la variable planilla no es null, muestre su contenido, de lo contrario no muestre el icono  ::::--}}
          @if($pago->planilla!=NULL)
         <tr>
            <th scope="col">Planilla</th>
             <td>
                <a href="{{route('clientes.pagos.bajar_planilla',$pago->id)}}" class="btn btn-warning" title="Descargar Planilla">
                    <i class="fa fa-download" aria-hidden="true"></i></a>
            </td>
        </tr>
        @endif
        </thead>
        
    </table>
  </div>
</div>
</div>
</div>

    
@endsection