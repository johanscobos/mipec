@extends('layouts.principal')
@section('content')
 {!! Form::open(['route' => 'clienteEmpleado', 'method' => 'post', 'novalidate' => 'novalidate']) !!}

  {!!Form::label('cliente', 'Clientes: ');!!}
            <select name="cliente">
        @foreach($cliente  as $cliente)
            <option value= {{$cliente->id}}>{{$cliente->nombres }}</option>
        @endforeach
        </select>
        <br>
 {!! Form::submit('Registrar'); !!}
{!! Form::close() !!}
@endsection