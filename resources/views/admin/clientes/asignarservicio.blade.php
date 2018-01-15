@extends('layouts.principal')
@section('title','Clientes - Asignar Servicios')
@section('content')

    <h2>Asignar Servicios</h2>
    @include('flash::message')
    {!! Form::open(['route' => 'clientes.store', 'method' => 'post']) !!}
    @foreach($errors->all() as $error)
        <p class="alert alert-danger">{{$error}}</p>
    @endforeach
    <div class="container">
        <div class="row">
            <div>
                <div class="form-group">
                    {!!Form::label('clientes', 'Nombre del cliente');!!}
                    {!! Form::select('cliente_id',$clientes, ['class' => 'form-control']) !!}

                     <select class="itemName form-control" style="width:500px;" name="itemName"></select>
                </div>
                <div class="form-group">
                    {!!Form::label('servicios', 'Nombre del Servicio');!!}
                    {!! Form::select('servicio_id',$servicios, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!!Form::label('valor_pagar', 'Valor del servicio');!!}
                    {!! Form::number('valor_pagar',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!!Form::label('descripcion_variable', 'Descripcion variable');!!}
                    {!! Form::text('descripcion_variable',null, ['class' => 'form-control']) !!}
                </div>

                <br>
                {!! Form::submit('Enviar',['class' => 'btn btn-primary']); !!}
                {!! Form::close() !!}

            </div>
        </div>
    </div>

  <script type="text/javascript">


      $('.itemName').select2({
        placeholder: 'Select an item',
        ajax: {
          url: '/select2-autocomplete-ajax',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.nombres,
                        id: item.id
                    }
                })
            };
          },
          cache: true
        }
      });


</script>

@endsection