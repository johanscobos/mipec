@php
    use App\User;
@endphp

@extends('layouts.principal')
@section('title','Clientes - Pagos de clientes')
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
      <a href="{{url('admin/servicios/create')}}" class="btn btn-primary">Crear servicio</a>
      <button id="btn_add" name="btn_add" class="btn btn-primary pull-right">Nuevo Producto</button>
  </div>
</div>

 <div class="row cabez-table">
  <div class="col-12">
         <table class="table">
        <thead class="thead-dark bg-table">
        <tr>            
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>  
            <th scope="col">Acciones</th>                         
        </tr>
        </thead>
        <tbody>
        @foreach($servicios as $servicio)
            <tr>
                <td>{{$servicio->nombre}}</td>
                <td>{{$servicio->descripcion}}</td>
                <td>
                    <a href="{{route('clientes.pagos.bajar_planilla',$servicio->id)}}" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <a href="" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
  </div>
</div>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      <h4 class="modal-title" id="myModalLabel">Producto</h4>
     </div>
     <div class="modal-body">
      <form id="frmproductos" name="frmproductos" class="form-horizontal" novalidate="">
       <div class="form-group error">
        <label for="inputName" class="col-sm-3 control-label">Nombre</label>
        <div class="col-sm-9">
         <input type="text" class="form-control has-error" id="nombre" name="nombre" placeholder="Product Name" value="">
        </div>
       </div>
       <div class="form-group">
        <label for="inputDetail" class="col-sm-3 control-label">Descripcion</label>
        <div class="col-sm-9">
         <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="details" value="">
        </div>
       </div>
      </form>
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-primary" id="btn-save" value="add">Guardar</button>
      <input type="hidden" id="producto_id" name="producto_id" value="0">
     </div>
    </div>
   </div>
  </div>


@endsection

