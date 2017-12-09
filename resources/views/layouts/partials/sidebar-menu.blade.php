
<ul>
	

<ul class="lista">
	<b>Administrador</b><br>

    <li><a href="{{url('admin/administrador/create')}}">Crear Usuarios</a></li>
    <li><a href="{{url('admin/servicios/create')}}">Crear Servicios</a></li>
    <li><a href="{{url('admin/administrador/clienteEmpleado')}}">Asignar empleado a cliente</a></li>

    <li><a href="{{url('admin/clientes/asignarservicio')}}">Asignar servicio a cliente</a></li>
    <li><a href="{{url('admin/clientes/gestionar_servicios')}}">Activar/Inactivar Cliente</a></li>
    <li><a href="{{url('/clientes/pagos')}}">Pagos Clientes</a></li>


    <b>Clientes</b><br>
    <li><a href="{{url('clientes/pagos/pagospendientes')}}">Servicios por pagar</a></li>

    <li><a href="{{url('/clientes/pagos/ver_pagos')}}">Historial de pagos</a></li>

    <b>Empleados</b>
    <li><a href="{{url('admin/empleados/verClientes')}}">Ver mis clientes</a></li>
</ul>