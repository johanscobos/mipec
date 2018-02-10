@php
    use App\User;
@endphp

@extends('layouts.principal')
@section('title','Servicios por pagar')
@section('content')

<div class="container">
 <div class="row mix-top">
  <div class="col-6">
    <h1>Servicios por pagar</h1>
    @include('flash::message')
  </div>
  <div class="col-4">
     
    {!! Form::open(['route' => 'serviciosporpagar', 'method' => 'get', 'class'=>'form-inline float-right']) !!}
    <div class="form-group">
        {!! Form::text('dato',null,['class' => 'form-control mr-sm-2', 'placeholder' => 'Dato de búsqueda'] )!!}
    </div>
        <div class="form-group">
    {!! Form::submit('Filtrar',['class' => 'btn btn-outline-success my-2 my-sm-0']); !!}
   </div>
    {!! Form::close() !!}
  </div>
  <div class="col-2">
    <a href="{{ route('serviciosporpagar',['dato' => ''])}}" class="btn btn-outline-success"><i class="fa fa-filter" aria-hidden="true"></i> Eliminar filtro</a>
  </div>
</div>

 <div class="row cabez-table">
  <div class="col-12">
         <table class="table">
        <thead class="thead-dark bg-table">
        <tr>            
            <th scope="col">Cliente</th>
            <th scope="col">Cédula</th>
            <th scope="col">Ref. Pago</th>
            <th scope="col">Servicio</th>
            <th scope="col">Descripción</th>
            <th scope="col">Valor</th>  
            <th scope="col">Acción</th>      
        </tr>
        </thead>
        <tbody>
        @foreach($serviciosporpagar as $serviporpagar)
            <tr data-id="{{$serviporpagar->servicio_id}}">
               <td>{{$serviporpagar->nombres.' '.$serviporpagar->apellidos}}</td>
               <td>{{$serviporpagar->cedula}}</td>
               <td>{{$serviporpagar->referenceCode}}</td>
               <td>{{$serviporpagar->nombre}}</td>
               <td>{{$serviporpagar->descripcion}}</td>
               <td class="text-right">
                @php
                    //le doy formato de miles al valor pagado
                    echo $vpago=number_format($serviporpagar->valor_pagar);
                 @endphp
              </td>
              <td class="flex-crud">
                   <div class="flex-crud_item">
                      <a href="{{route('detalles_servicioporpagar',$serviporpagar->id)}}" class="btn btn-primary" title="Ver Detalles"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    </div>                 
              </td>
            </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</div>
</div>
@include('layouts.partials.scripts')
@endsection



