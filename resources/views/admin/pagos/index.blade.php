@php
    use App\User;
@endphp

@extends('layouts.principal')
@section('title','Servicios')
@section('content')


<div class="container">
 <div class="row mix-top">
  <div class="col-6">
    <h1>Pagos</h1>
    @include('flash::message')
  </div>
  <div class="col-4">
      {!! Form::open(['method' => 'get', 'class'=>'form-inline','role'=>'search']) !!}
    <div class="form-group">
        {!! Form::text('dato',null,['class' => 'form-control mr-sm-2', 'placeholder' => 'Cliente - Cedula - Ref.'] )!!}
    </div>
    <div class="form-group">
    {!! Form::submit('Buscar',['class' => 'btn btn-outline-success my-2 my-sm-0']); !!}
   </div>

    {!! Form::close() !!}

  </div>
  <div class="col-2">
      <a href="{{route('servicios.create')}}" class="btn btn-crear btn-primary">Crear servicio</a>

  </div>
</div>

 <div class="row cabez-table">
  <div class="col-12">
         <table class="table">
        <thead class="thead-dark bg-table">
        <tr>          
           <th scope="col">Cliente</th>
           <th scope="col">Cédula</th>
           <th scope="col">Servicio</th>
           <th scope="col">Referencia</th>  
            <th scope="col">Valor pago $</th>
            <th scope="col">Descripción</th>
                                               
        </tr>
        </thead>
        <tbody>
          @php
          //dd($pagos);
          @endphp
        @foreach($pagos as $pago)
            <tr data-id="{{$pago->id}}">
                <td>{{$pago->nombres.' '.$pago->apellidos}}</td>
                <td>{{$pago->cedula}}</td>
                <td>{{$pago->servicio_id}}</td>
                <td>{{$pago->referenceCode}}</td>
                <td>$ {{$pago->valor_pago}}</td>
                <td>{{$pago->descripcion}}</td>
                
                
            </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</div>
</div>
@include('layouts.partials.scripts')
@endsection



