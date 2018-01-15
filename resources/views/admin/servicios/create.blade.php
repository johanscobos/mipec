
@extends('layouts.principal')
@section('title','Crear Servicios')
@section('content')



<h2>Crear Servicio</h2>
    @include('flash::message')
    {!! Form::open(['route' => 'servicios.store', 'method' => 'post']) !!}
    @foreach($errors->all() as $error)
    <p class="alert alert-danger">{{$error}}</p>
    @endforeach

<div class="container">
    <div class="row">
        <div>
            <div class="form-group">
                {!!Form::label('servicio', 'Nombre del servicio');!!}
                {!!Form::text('nombre',null,['class' => 'form-control'], $attributes=['required']) ; !!}

                {!!Form::label('valor', 'Valor $');!!}
                {!!Form::number('valor',null,['class' => 'form-control']) ; !!}

                {!!Form::label('descripcion', 'Descripción');!!}
                {!!Form::textarea('descripcion',null,['class' => 'form-control'], $attributes=['required']) ; !!}
            </div>

            <br>
            {!! Form::submit('Enviar',['class' => 'btn btn-primary']); !!}
            {!! Form::close() !!}

        </div>
    </div>
</div>



@endsection

 