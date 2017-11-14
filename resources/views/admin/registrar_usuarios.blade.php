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
    {!!Form::select('tipo_user',['cliente' => 'Cliente', 'Asesor' => 'Asesor','Consultor' => 'Consultor' ],null, $attributes=['required']);  !!}
    <br>
    {!!Form::label('password', 'Contraseña');!!}
    {!!Form::password('password', ['class' => 'awesome']);!!}



    <br>
    {!! Form::submit('Registrar'); !!}
    {!! Form::close() !!}
    <div id="test">algo</div>



@endsection

@section('script')

    <script type="text/javascript">

            $("#tipo_user").on("change", function(){
                alert("hola");
            });

    </script>
@endsection