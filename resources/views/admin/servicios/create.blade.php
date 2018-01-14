
@extends('layouts.principal')
@section('title','Crear Servicios')
@section('content')



<h2>Crear Servicios</h2>
    @include('flash::message')
    {!! Form::open(['route' => 'servicios.store', 'method' => 'post']) !!}
    @foreach($errors->all() as $error)
    <p class="alert alert-danger">{{$error}}</p>
    @endforeach
    <div class="form-group">
        {!!Form::label('servicio', 'Nombre del servicio');!!}
        {!!Form::text('nombre',null,['class' => 'form-control'], $attributes=['required']) ; !!}

        {!!Form::label('descripcion', 'Descripción');!!}
        {!!Form::text('descripcion',null,['class' => 'form-control'], $attributes=['required']) ; !!}
    </div>

    <br>
    {!! Form::submit('Enviar',['class' => 'btn btn-primary']); !!}
    {!! Form::close() !!}

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


@endsection

 