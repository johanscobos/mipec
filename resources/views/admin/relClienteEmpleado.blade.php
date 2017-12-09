@extends('layouts.principal')


@section('content')

{!! Form::open(['route' => 'guardarRelacion', 'method' => 'post', 'novalidate' => 'novalidate']) !!}


 {!!Form::hidden('id',$value=$id, $attributes=['required']);  !!}

{!!Form::label('empleados', 'Empleado: ');!!}
        <select name="empleados">
        @foreach($empleado as $empleado)
            <option value= {{$empleado->id}}>{{$empleado->nombres }}</option>
        @endforeach
        </select>
        <br>

{!! Form::submit('Relacionar'); !!}
{!! Form::close() !!}

@endsection