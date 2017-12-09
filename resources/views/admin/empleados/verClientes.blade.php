@extends('layouts.principal')
@section('content')


@foreach($cliente as $cliente)

<ul>
	<li><a href="{{route('conclusiones')}}">{{$cliente->nombres}}</a></li>
</ul>
@endforeach
@endsection