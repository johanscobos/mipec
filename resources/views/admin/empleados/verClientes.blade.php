@extends('layouts.principal')
@section('content')


@foreach($cliente as $cliente)

<ul>
	<li>{{$cliente->nombres}}</li>
</ul>
@endforeach
@endsection