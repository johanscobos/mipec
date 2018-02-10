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
      {!! Form::open(['method' => 'get', 'class'=>'form-inline float-right','role'=>'search']) !!}
    <div class="form-group">
        {!! Form::text('dato',null,['class' => 'form-control mr-sm-2', 'placeholder' => 'Dato de búsqueda'] )!!}
    </div>
    <div class="form-group">
    {!! Form::submit('Filtrar',['class' => 'btn btn-outline-success my-2 my-sm-0']); !!}
   </div>

    {!! Form::close() !!}

  </div>
  <div class="col-2">
      <a href="{{ route('pagos',['dato' => ''])}}" class="btn btn-outline-success "><i class="fa fa-times-circle" aria-hidden="true"></i> Eliminar filtro</a>

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
           <th scope="col">Ref. Pago</th>
            <th scope="col">Valor Pago</th>
            <th scope="col">Descripción</th>
            <th scope="col">Acción</th>                                               
        </tr>
        </thead>
        <tbody>
          
        @foreach($pagos as $pago)
            <tr data-id="{{$pago->id}}">
                <td>{{$pago->nombres.' '.$pago->apellidos}}</td>
                <td>{{$pago->cedula}}</td>
                <td>{{$pago->nombre}}</td>
                <td>{{$pago->referenceCode}}</td>
                <td>
                   $
                 @php
                    //le doy formato de miles al valor pagado
                    echo $vpago=number_format($pago->valor_pago);
                 @endphp

                </td>
                <td>{{$pago->descripcion}}</td>
                <td class="flex-crud">
                   @php
                    //capturo el usuario autenticado
                    $user = Auth::user();                  
                  @endphp
                  
                  {{-- ::::: Si el tipo rol del usuario autenticado es diferente de "cliente" (11), se le muestra la opción de edita el pago, de lo contrario no se mostrará ::::--}}
                  @if($user->tipo_rol!=11)
                      <div class="flex-crud_item">
                        <a href="{{route('pagos.edit',$pago->id)}}" class="btn btn-warning" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    </div>
                  @endif
                 <div class="flex-crud_item">
                        <a href="{{route('pagos.show',$pago->id)}}" class="btn btn-primary" title="Detalles"><i class="fa fa-eye" aria-hidden="true"></i></a>
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



