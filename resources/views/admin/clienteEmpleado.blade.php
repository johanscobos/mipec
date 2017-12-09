@extends('layouts.principal')
@section('content')

    <h2>Asignar Empleado a Cliente</h2>

  <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Cliente</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cliente as $cliente)
            <tr>
                <th scope="row">{{$cliente->id}}</th>
                <td>{{$cliente->nombres. ' '.$cliente->apellidos}}</td>
                
                
                    <td><a href="{{route('clienteEmpleado',$cliente->id)}}" class="btn btn-danger">Asociar cliente a empleado</a> </td>
                
                    
                

            </tr>
        @endforeach
        
        </tbody>
    </table>
@endsection