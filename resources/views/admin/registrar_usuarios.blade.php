@extends('layouts.principal')


@section('content')
    <h2>Registrar usuarios</h2>

{!! Form::open(['route' => 'administrador.store', 'method' => 'post', 'novalidate' => 'novalidate']) !!}

    {!!Form::label('Nombre de usuario', 'Username');!!}
    {!!Form::text('username',null, ['class' => 'form-control'],$attributes=['required']);  !!}
    <br>
    {!!Form::label('email', 'Correo electronico');!!}
    {!!Form::email('email',null, ['class' => 'form-control'],$attributes=['required']);  !!}
    <br>
    {!!Form::label('tipo_user', 'Tipo de usuario');!!}
    {!!Form::select('tipo_user',[-1=>'seleccione una opcion',1 => 'Cliente', 0 => 'Empleado' ],null, $attributes=['required']);  !!}
    <br>
    {!!Form::label('roles', 'Rol: ');!!}
            <select name="roles">
        @foreach($roles  as $rol)
            <option value= {{$rol->id}}>{{$rol->name }}</option>
        @endforeach
        </select>
        <br>

    {!!Form::label('password', 'Contraseña');!!}
    {!!Form::password('password', ['class' => 'awesome form-control']);!!}

    <br>

    
    <div id="formulario-empleado" style="display:none;">
        {!!Form::label('cedula', 'Número de cedula :');!!}
        {!!Form::text('cedulaem',null, ['class' => 'form-control'],$attributes=['required']);  !!}
        <br>
        {!!Form::label('nombres', 'Nombre del empleado :');!!}
        {!!Form::text('nombresem',null, ['class' => 'form-control'],$attributes=['required']);  !!}
        <br>
        {!!Form::label('apellidos', 'Apellidos :');!!}
        {!!Form::text('apellidosem',null, ['class' => 'form-control'],$attributes=['required']);  !!}
        <br>
        {!!Form::label('telefono', 'Número de telefono :');!!}
        {!!Form::text('telefonoem',null, ['class' => 'form-control'],$attributes=['required']);  !!}
        <br>
        {!!Form::label('celular', 'Número de celular :');!!}
        {!!Form::text('celularem',null, ['class' => 'form-control'],$attributes=['required']);  !!}
        <br>
        {!!Form::label('direccion', 'Dirección :');!!}
        {!!Form::text('direccionem',null, ['class' => 'form-control'],$attributes=['required']);  !!}
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
        {!!Form::text('cedula',null, ['class' => 'form-control'],$attributes=['required']);  !!}
        <br>
        {!!Form::label('nombres', 'Nombre del empleado :');!!}
        {!!Form::text('nombres',null, ['class' => 'form-control'],$attributes=['required']);  !!}
        <br>
        {!!Form::label('apellidos', 'Apellidos :');!!}
        {!!Form::text('apellidos',null, ['class' => 'form-control'],$attributes=['required']);  !!}
        <br>
        {!!Form::label('telefono', 'Número de telefono :');!!}
        {!!Form::text('telefono',null, ['class' => 'form-control'],$attributes=['required']);  !!}
        <br>
        {!!Form::label('celular', 'Número de celular :');!!}
        {!!Form::text('celular',null, ['class' => 'form-control'],$attributes=['required']);  !!}
        <br>
        {!!Form::label('direccion', 'Dirección :');!!}
        {!!Form::text('direccion',null, ['class' => 'form-control'],$attributes=['required']);  !!}
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


    {!! Form::submit('Registrar',['class' => 'btn btn-primary']); !!}
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