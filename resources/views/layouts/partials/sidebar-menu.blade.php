
<ul class="lista">
    @can('crearUsuarios')
    <li><a href="{{url('admin/administrador/create')}}">Crear Usuarios</a></li>
    @endcan

    @can('editarUsuarios')
    <li><a href="">Editar Usuarios</a></li>
    @endcan

    @can('eliminarUsuarios')
    <li><a href="">Eliminar Usuarios</a></li>
    @endcan

    @can('asociarEmpleadoCliente')
    <li><a href="{{url('admin/administrador/clienteEmpleado')}}">Asignar empleado a cliente</a></li>
    @endcan

    @can('crearServicio')
    <li><a href="{{url('admin/servicios/create')}}">Crear Servicios</a></li>
    @endcan

    @can('editarServicio')
    <li><a href="">Editar Servicios</a></li>
    @endcan

    @can('eliminarServicio')
    <li><a href="">Eliminar Servicios</a></li>
    @endcan

    @can('asignarServicio')
    <li><a href="{{url('admin/clientes/asignarservicio')}}">Asignar servicio a cliente</a></li>
    @endcan

    @can('ActivarServicio')
    <li><a href="{{url('admin/clientes/gestionar_servicios')}}">Activar Servicio</a></li>
    @endcan

    @can('inactivarServicio')
    <li><a href="">Inactivar Servicio</a></li>
    @endcan


    @can('pagosClientes')
    <li><a href="{{url('/clientes/pagos')}}">Listar Pagos de Clientes</a></li>
    @endcan

    @can('serviciosPorPagar')

    <li><a href="{{url('clientes/pagos/pagospendientes')}}">Servicios por pagar</a></li>
    @endcan

    @can('historialPagos')
    <li><a href="{{url('/clientes/pagos/ver_pagos')}}">Historial de pagos</a></li>
    @endcan

    @can('verClientesDeEmpleados')
    <li><a href="">Ver clientes de empleados</a></li>
    @endcan

    @can('verPropiosClientes')
    <li><a href="{{url('admin/empleados/verClientes')}}">Ver mis clientes</a></li>
    @endcan


    {{--<li><a href="{{url('admin/empleados/historialConversaciones')}}">Historico conversaciones</a></li>--}}
</ul>




