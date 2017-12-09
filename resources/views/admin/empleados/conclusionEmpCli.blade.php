@extends('layouts.principal')
@section('content')


{!! Form::open(['route' => 'empleados.store', 'method' => 'post', 'novalidate' => 'novalidate']) !!}

{!!Form::label('conclusion', 'Conclusion :');!!}
        {!!Form::text('conclusion',null, ['class' => 'form-control'],$attributes=['required']);  !!}
        <br>

{!! Form::submit('Agregar',['class' => 'btn btn-primary']); !!}
{!! Form::close() !!}
@endsection