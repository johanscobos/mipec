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
     
    {!! Form::open(['route' => 'serviciosporpagar', 'method' => 'get', 'class'=>'form-inline']) !!}
    <div class="form-group">
        {!! Form::text('dato',null,['class' => 'form-control mr-sm-2', 'placeholder' => 'Datos Cliente'] )!!}
    </div>
        <div class="form-group">
    {!! Form::submit('Buscar',['class' => 'btn btn-outline-success my-2 my-sm-0']); !!}
   </div>

    {!! Form::close() !!}

  </div>
  <div class="col-2">
     

  </div>
</div>

 <div class="row cabez-table">
  <div class="col-12">
         <table class="table">
        <thead class="thead-dark bg-table">
        <tr>            
            <th scope="col">Cliente</th>
            <th scope="col">Cedula</th>
            <th scope="col">Servicio</th>
            <th scope="col">Descripción</th>
            <th scope="col">Valor $</th>
            <th scope="col">Ref. Pago</th>
                                   
        </tr>
        </thead>
        <tbody>
          @php
            
            //dd($datos);
            @endphp
         
        @foreach($datos as $dato)

         @php
            
            // saco el id del primer objeto
              
              $clservicios = DB::table('cliente_servicio')->where([
                    ['cliente_id', '=', $dato->id],
                    ['estado_pago', '=', 1],
                ])->get();

              //dd($clservicios);

          
                    //Instancio el servicio con el id
                   //  $servicio = App\Servicio::find($serviporpagar->servicio_id);

                    //Instancio el cliente con el id
                   // $cliente = App\Cliente::find($serviporpagar->cliente_id);
                @endphp

                @foreach($clservicios as $clservicio )
                <tr data-id="{{$clservicio->cliente_id}}">
               <td>{{$clservicio->descripcion_variable}}</td>
               <td>{{$clservicio->referenceCode}}</td>
               <td>{{$clservicio->referenceCode}}</td>
               <td>{{$clservicio->referenceCode}}</td>
               <td>{{$clservicio->referenceCode}}</td>
               <td>{{$clservicio->referenceCode}}</td>
             
            </tr>

                     
@php
                 //   dd($clservicio->cliente_id);
@endphp

            @endforeach
        @endforeach
        </tbody>
    </table>
  </div>
</div>
</div>
@include('layouts.partials.scripts')
@endsection



