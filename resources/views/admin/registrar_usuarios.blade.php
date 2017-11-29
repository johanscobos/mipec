@extends('layouts.principal')


@section('content')
{!! Form::open(['route' => 'administrador.store', 'method' => 'post', 'novalidate' => 'novalidate']) !!}

    {!!Form::label('Nombre de usuario', 'Username');!!}
    {!!Form::text('username',null, $attributes=['required']);  !!}
    <br>
    {!!Form::label('email', 'Correo electronico');!!}
    {!!Form::email('email',null, $attributes=['required']);  !!}
    <br>
    {!!Form::label('tipo_user', 'Tipo de usuario');!!}
    {!!Form::select('tipo_user',[-1=>'seleccione una opcion',1 => 'Cliente', 0 => 'Empleado' ],null, $attributes=['required']);  !!}
    <br>
    {!!Form::label('password', 'Contraseña');!!}
    {!!Form::password('password', ['class' => 'awesome']);!!}



    <br>

    
    <div id="formulario-empleado" style="display:none;">
        {!!Form::label('cedula', 'Número de cedula :');!!}
        {!!Form::text('cedula',null, $attributes=['required']);  !!}
        <br>
        {!!Form::label('nombres', 'Nombre del empleado :');!!}
        {!!Form::text('nombres',null, $attributes=['required']);  !!}
        <br>
        {!!Form::label('apellidos', 'Apellidos :');!!}
        {!!Form::text('apellidos',null, $attributes=['required']);  !!}
        <br>
        {!!Form::label('telefono', 'Número de telefono :');!!}
        {!!Form::text('telefono',null, $attributes=['required']);  !!}
        <br>
        {!!Form::label('celular', 'Número de celular :');!!}
        {!!Form::text('celular',null, $attributes=['required']);  !!}
        <br>
        {!!Form::label('direccion', 'Dirección :');!!}
        {!!Form::text('direccion',null, $attributes=['required']);  !!}
        <br>
        
        {!!Form::label('paises', 'Pais: ');!!}
            <select name="paises">
        @foreach($paises  as $pais)
            <option value= {{$pais->codigo}}>{{$pais->nombre }}</option>
        @endforeach
        </select>
        <br>
        
        {!!Form::label('ciudades', 'Ciudad: ');!!}
        <select name="ciudades">
        @foreach($ciudades as $ciudad)
            <option value= {{$ciudad->id}}>{{$ciudad->nombre }}</option>
        @endforeach
        </select>

    </div>

    <div id="formulario-cliente" style="display:none;">
        {!!Form::label('cedula', 'Número de cedula :');!!}
        {!!Form::text('cedula',null, $attributes=['required']);  !!}
        <br>
        {!!Form::label('nombres', 'Nombre del empleado :');!!}
        {!!Form::text('nombres',null, $attributes=['required']);  !!}
        <br>
        {!!Form::label('apellidos', 'Apellidos :');!!}
        {!!Form::text('apellidos',null, $attributes=['required']);  !!}
        <br>
        {!!Form::label('telefono', 'Número de telefono :');!!}
        {!!Form::text('telefono',null, $attributes=['required']);  !!}
        <br>
        {!!Form::label('celular', 'Número de celular :');!!}
        {!!Form::text('celular',null, $attributes=['required']);  !!}
        <br>
        {!!Form::label('direccion', 'Dirección :');!!}
        {!!Form::text('direccion',null, $attributes=['required']);  !!}
        <br>
        
        {!!Form::label('paises', 'Pais: ');!!}
            <select name="paises">
        @foreach($paises  as $pais)
            <option value= {{$pais->codigo}}>{{$pais->nombre }}</option>
        @endforeach
        </select>
        <br>
        
        {!!Form::label('ciudades', 'Ciudad: ');!!}
        <select name="ciudades">
        @foreach($ciudades as $ciudad)
            <option value= {{$ciudad->id}}>{{$ciudad->nombre }}</option>
        @endforeach
        </select>

        <br>
        
        {!!Form::label('empleados', 'Empleado: ');!!}
        <select name="empleados">
        @foreach($empleados as $empleado)
            <option value= {{$empleado->id}}>{{$empleado->nombres }}</option>
        @endforeach
        </select>

    </div>


{!! Form::submit('Registrar'); !!}
{!! Form::close() !!}


@endsection

@section('scripts')

    <script type="text/javascript">

        $(document).ready(function(){
            $("#tipo_user").on("change", function(){
                if(($('select[id=tipo_user]').val()) == 1){
                    $("#formulario-cliente").show();
                    $("#formulario-empleado").hide();
                }
                if(($('select[id=tipo_user]').val()) == 0){
                    $("#formulario-empleado").show();
                    $("#formulario-cliente").hide();
                }

            });});

    </script>
@endsection