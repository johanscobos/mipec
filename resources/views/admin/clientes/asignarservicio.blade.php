@extends('layouts.principal')
@section('title','Clientes - Asignar Servicios')
@section('content')

    <div class="container top">
        <div class="row mix-top">
            <div class="col-12">
                <h1>Asignar Servicio a Cliente</h1>
                @include('flash::message')
                {!! Form::open(['route' => 'clientes.store', 'method' => 'post']) !!}
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
                    {!!Form::label('clientes', 'Nombre del Cliente');!!}<br>
                    {!! Form::select('cliente_id',$clientes, null, ['placeholder' => 'Busque un cliente','class'=>'cll form-control']) !!}

                </div>
                <div class="form-group">
                    {!!Form::label('servicios', 'Nombre del Servicio');!!}<br>
                    {!! Form::select('servicio_id',$servicios,null, ['placeholder' => 'Elija un servicio','class' => 'servicio form-control','id'=>'ser']) !!}
                </div>
                <div class="form-group">
                    {!!Form::label('valor_pagar', 'Valor del servicio $');!!}
                    {!! Form::text('valor_pagar',null, ['class' => 'form-control','id'=>'valor']) !!}
                </div>
                <div class="form-group">
                    {!!Form::label('descripcion_variable', 'Descripcion variable');!!}
                    {!! Form::textarea('descripcion_variable',null, ['class' => 'form-control']) !!}
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
        $('.cll').select2();
        $('.servicio').select2();
    </script>

@endsection