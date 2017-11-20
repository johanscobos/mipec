@extends('layouts.principal')


@section('content')
{!! Form::open(['route' => 'administrador.store', 'method' => 'post']) !!}

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

    <div id="formulario-cliente" style="display:none;">


    </div>
    <div id="formulario-empleado" style="display:none;">
        {!!Form::label('cedula', 'Número de cedula :');!!}
        {!!Form::text('cedula',null, $attributes=['required']);  !!}
        <br>
        {!!Form::label('nombres', 'Nombre del empleado :');!!}
        {!!Form::text('nombres',null, $attributes=['required']);  !!}
        <br>
        {!!Form::label('apellido1', 'Primer apellido :');!!}
        {!!Form::text('apellido1',null, $attributes=['required']);  !!}
        <br>
        {!!Form::label('apellido2', 'Segundo apellido :');!!}
        {!!Form::text('apellido2',null, $attributes=['required']);  !!}
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
        @foreach($paises as $pais)
        {!!Form::label('paises', 'Pais: ');!!}
            {!!Form::select('paises',[0=>'seleccione el pais',$pais->id =>$pais->nombre],null, $attributes=['required']);  !!}
        @endforeach

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