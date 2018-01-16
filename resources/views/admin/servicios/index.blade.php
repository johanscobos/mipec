@php
    use App\User;
@endphp

@extends('layouts.principal')
@section('title','Servicios')
@section('content')


<div class="container">
 <div class="row mix-top">
  <div class="col-6">
    <h1>Servicios</h1>
    @include('flash::message')
  </div>
  <div class="col-4">
      {!! Form::open(['method' => 'get', 'class'=>'form-inline','role'=>'search']) !!}
    <div class="form-group">
        {!! Form::text('dato',null,['class' => 'form-control mr-sm-2', 'placeholder' => 'Nombre del servicio'] )!!}
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
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Valor $</th>
            <th scope="col">Acciones</th>                         
        </tr>
        </thead>
        <tbody>
        @foreach($servicios as $servicio)
            <tr data-id="{{$servicio->id}}">
                <td>{{$servicio->nombre}}</td>
                <td>{{$servicio->descripcion}}</td>
                <td>{{$servicio->valor}}</td>
                <td class="flex-crud">
                    <div class="flex-crud_item">
                        <a href="{{route('servicios.edit',$servicio->id)}}" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    </div>
                    <div class="flex-crud_item">
                        {!! Form::open(['route' => ['servicios.destroy', $servicio->id],'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-delete btn-danger" onclick="return confirm('¿Está seguro que desea eliminar el servicio?')"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        {!! Form::close() !!}
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



