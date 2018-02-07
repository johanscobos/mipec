@php
    use App\User;

@endphp

@extends('layouts.principal')
@section('title','Servicios por pagar')
@section('content')


<div class="container">
 <div class="row mix-top">
  <div class="col-6">
    <h1>Clientes Consultores</h1>
    @include('flash::message')
  </div>
  <div class="col-4">
     
    {!! Form::open(['route' => 'clientesConsultor', 'method' => 'get', 'class'=>'form-inline float-right']) !!}
    <div class="form-group">
        {!! Form::text('dato',null,['class' => 'form-control mr-sm-2', 'placeholder' => 'Dato de búsqueda'] )!!}
    </div>
        <div class="form-group">
    {!! Form::submit('Filtrar',['class' => 'btn btn-outline-success my-2 my-sm-0']); !!}
   </div>
    {!! Form::close() !!}
  </div>
  <div class="col-2">
    <a href="{{ route('clientesConsultor',['dato' => ''])}}" class="btn btn-outline-success"><i class="fa fa-filter" aria-hidden="true"></i> Eliminar filtro</a>
  </div>

</div>

 <div class="row cabez-table">
  <div class="col-12">
         <table class="table">
        <thead class="thead-dark bg-table">
        <tr>            
            <th scope="col">Consultor</th>
            <th scope="col">Cédula</th>
            <th scope="col">Cliente</th>
            <th scope="col">Cédula</th>
        </tr>
        </thead>
        <tbody>
        @foreach($consultores as $consultor)


            <tr data-id="{{$consultor->servicio_id}}">
               <td>{{$consultor->nombres.' '.$consultor->apellidos}}</td>
               <td>{{$consultor->cedula}}</td>
                <td class="bgcol">{{$consultor->nombresclientes.' '.$consultor->apellidosclientes}}</td>
                <td class="bgcol">{{$consultor->cedulaclientes}}</td>
             
            </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</div>
</div>
@include('layouts.partials.scripts')
@endsection



