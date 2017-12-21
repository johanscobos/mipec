
<ul>
	

<ul class="lista">
    @can('crearUsuarios')
	<b>Administrador</b><br>

    <li><a href="{{url('admin/administrador/create')}}">Crear Usuarios</a></li>
    @endcan

    @can('crearServicio')
    <li><a href="{{url('admin/servicios/create')}}">Crear Servicios</a></li>
        @endcan

   @can('asociarEmpleadoCliente')
    <li><a href="{{url('admin/administrador/clienteEmpleado')}}">Asignar empleado a cliente</a></li>
   @endcan
    <li><a href="{{url('admin/clientes/asignarservicio')}}">Asignar servicio a cliente</a></li>
    <li><a href="{{url('/clientes/pagos')}}">Listar Pagos de Clientes</a></li>

    <li><a href="{{url('admin/clientes/gestionar_servicios')}}">Activar/Inactivar Servicio</a></li>



    <b>Clientes</b><br>
    <li><a href="{{url('clientes/pagos/pagospendientes')}}">Servicios por pagar</a></li>

    <li><a href="{{url('/clientes/pagos/ver_pagos')}}">Historial de pagos</a></li>

    <b>Empleados</b>
    <li><a href="{{url('admin/empleados/verClientes')}}">Ver mis clientes</a></li>
    <li><a href="{{url('admin/empleados/historialConversaciones')}}">Historico conversaciones</a></li>
</ul>


    

