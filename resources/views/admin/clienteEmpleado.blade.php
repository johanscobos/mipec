@extends('layouts.principal')
@section('content')

    <div class="container top">
        <div class="row mix-top">
            <div class="col-12">
                <h1>Asignar Cliente a Empleado</h1>
                @include('flash::message')
                {!! Form::open(['route' => 'guardarRelacion', 'method' => 'post']) !!}

                @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{{$error}}</p>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div>
                <div class="form-group">
                    {!!Form::label('consultor', 'Nombre del Consultor');!!}<br>
                    {!! Form::select('empleado_id',$empleados, null, ['placeholder' => 'Busque un Consultor','class'=>'consultor form-control']) !!}
                </div>
                <div class="form-group">
                    {!!Form::label('clientes', 'Nombre del cliente');!!}<br>
                    {!! Form::select('cliente_id',$clientes,null, ['placeholder' => 'Elija un Cliente','class' => 'cliente form-control','id'=>'ser']) !!}
                </div>
                <br>
                {!! Form::submit('Asignar',['class' => 'btn btn-primary']); !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @include('layouts.partials.scripts')

    <script src="{{asset('js/dropdown.js')}}"></script>

    <script type="text/javascript">
        $('.consultor').select2();
        $('.cliente').select2();
    </script>

@endsection
