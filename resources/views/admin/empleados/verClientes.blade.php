@extends('layouts.principal')
@section('content')

	<h2>Ver mis Clientes</h2>



<table class="table table-striped">
	<thead>
	<tr>
		<th scope="col">Id</th>
		<th scope="col">Nombre</th>
		<th scope="col">Cédula</th>

		<th scope="col">Acción</th>
	</tr>
	</thead>
	<tbody>
	@foreach($cliente as $cliente)
		<tr>
			<th scope="row">{{$cliente->id}}</th>
			<td>{{$cliente->nombres. ' '.$cliente->apellidos}}</td>
			<td>{{$cliente->cedula}}</td>
            <td><a href="" class="btn btn-warning">D</a></td>


		</tr>
	@endforeach
	</tbody>
</table>

@endsection