@php
    use App\Cliente;
    use App\Servicio;
    use Illuminate\Support\Facades\Auth;
@endphp

@extends('layouts.principal')
@section('title','Clientes - Gestionar Servicios')
@section('content')

 
<div class="container">
 <div class="row mix-top">
  <div class="col-6">
    <h1>Servicios Clientes</h1>
    @include('flash::message')
  </div>
  <div class="col-4">
    {!! Form::open(['route' => 'clientes.gestionar_servicios', 'method' => 'get', 'class'=>'form-inline float-right']) !!}
    
    <div class="form-group">
     {!! Form::text('dato',null,['class' => 'form-control mr-sm-2', 'placeholder' => 'Dato de búsqueda'] )!!}
    </div>
    <div class="form-group">
    {!! Form::submit('Filtrar',['class' => 'btn btn-outline-success my-2 my-sm-0']); !!}


    </div>

    {!! Form::close() !!}

  </div>
  <div class="col-2">
      <a href="{{ route('clientes.gestionar_servicios',['dato' => ''])}}" class="btn btn-outline-success "><i class="fa fa-times-circle" aria-hidden="true"></i> Eliminar filtro</a>
  </div>
</div>


<div class="row cabez-table">
  <div class="col-12">


    @if(isset($clservicios))
    <table class="table">
        <thead class="thead-dark bg-table">
        <tr>
            <th scope="col">Cliente</th>
            <th scope="col">Cédula</th>
            <th scope="col">Servicio</th>
            <th scope="col">#Ref. Pago</th>
            <th scope="col">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clservicios as $clservicio)

            <tr>
                <td>{{$clservicio->nombres.' '.$clservicio->apellidos}}</td>
                <td>{{$clservicio->cedula}}</td>
                <td>{{$clservicio->nombre}}</td>
                <td>{{$clservicio->referenceCode}}</td>
                <td>

                    @if($clservicio->estado_servicio==0)

                        {!! Form::open(['route' => 'clientes.activar_inactivar_servicio', 'method' => 'post']) !!}
                        
                        <button type="submit" class="btn btn-delete btn-warning" title="Activar"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i></button>
                        {!! Form::hidden('cliente_id',$clservicio->id )!!}
                        {!! Form::hidden('rc',$clservicio->referenceCode )!!}
                        {!! Form::hidden('accion','1' )!!}
                        {!! Form::close() !!}


                    @else
                        {!! Form::open(['route' => 'clientes.activar_inactivar_servicio', 'method' => 'post']) !!}
                        
                         <button type="submit" class="btn btn-delete btn-danger" title="Inactivar"><i class="fa fa-hand-paper-o" aria-hidden="true"></i></button>
                        {!! Form::hidden('cliente_id',$clservicio->id )!!}
                        {!! Form::hidden('rc',$clservicio->referenceCode )!!}
                        {!! Form::hidden('accion','0' )!!}
                        {!! Form::close() !!}
                        @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    
    @endif
</div>
</div>
</div>
    @include('layouts.partials.scripts')

@endsection