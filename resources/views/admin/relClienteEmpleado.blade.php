@extends('layouts.principal')


@section('content')

        <h2>Buscar Empleado</h2>
        @include('flash::message')
{!! Form::open(['route' => 'guardarRelacion', 'method' => 'post', 'novalidate' => 'novalidate']) !!}


 {!!Form::hidden('id',$value=$id, $attributes=['required']);  !!}

{!!Form::label('empleados', 'Empleado: ');!!}
        <select name="empleados">
        @foreach($empleado as $empleado)
            <option value= {{$empleado->id}}>{{$empleado->nombres }}</option>
        @endforeach
        </select>
        <br>

{!! Form::submit('Relacionar',['class' => 'btn btn-primary']); !!}
{!! Form::close() !!}

@endsection