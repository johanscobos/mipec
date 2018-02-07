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
     {!! Form::text('cedula',null,['class' => 'form-control mr-sm-2', 'placeholder' => 'Datos cliente'] )!!}
    </div>
    <div class="form-group">
    {!! Form::submit('Buscar',['class' => 'btn btn-outline-success my-2 my-sm-0']); !!}

   </div>

    {!! Form::close() !!}

  </div>
  <div class="col-2">
      <a href="{{ route('clientes.gestionar_servicios',['dato' => ''])}}" class="btn btn-outline-success "><i class="fa fa-filter" aria-hidden="true"></i> Eliminar filtro</a>
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
            <th scope="col">Acción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clservicios as $clservicios)

            <tr>
                <td>
                    @php
                        $cliente_id=$clservicios->cliente_id;
                        $servicio_id=$clservicios->servicio_id;
                        $rc=$clservicios->referenceCode;
                        $estado_servicio_actual=$clservicios->estado_servicio;
                        $cliente = App\Cliente::find($cliente_id);
                        echo $cliente->nombres.' '.$cliente->apellido1.' '.$cliente->apellido2;
                    @endphp
                </td>
                <td>
                    @php
                        echo $cliente->cedula;
                    @endphp
                </td>


                <td>
                    @php
                        $servicio_id=$clservicios->servicio_id;
                        $servicio = App\Servicio::find($servicio_id);
                        echo $servicio->nombre;
                    @endphp
                </td>
                <td>

                    @if($estado_servicio_actual==0)



                        {!! Form::open(['route' => 'clientes.activar_inactivar_servicio', 'method' => 'post']) !!}
                        
                        <button type="submit" class="btn btn-delete btn-warning" title="Activar"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i></button>
                        {!! Form::hidden('cliente_id',$cliente_id )!!}
                        {!! Form::hidden('rc',$rc )!!}
                        {!! Form::hidden('accion','1' )!!}
                        {!! Form::close() !!}


                    @else
                        {!! Form::open(['route' => 'clientes.activar_inactivar_servicio', 'method' => 'post']) !!}
                        
                         <button type="submit" class="btn btn-delete btn-danger" title="Inactivar"><i class="fa fa-hand-paper-o" aria-hidden="true"></i></button>
                        {!! Form::hidden('cliente_id',$cliente_id )!!}
                        {!! Form::hidden('rc',$rc )!!}
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