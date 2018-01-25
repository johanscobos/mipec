
<ul class="menu-principal">
    @can('crearUsuarios')
        <li><i class="fa fa-user-o color" aria-hidden="true"></i> <a href="{{url('admin/administrador')}}">Usuarios</a></li>
    @endcan

        @can('listar_servicios')
            <li><i class="fa fa-gavel color" aria-hidden="true"></i> <a href="{{url('admin/servicios')}}">Servicios</a></li>
        @endcan

        @can('asignarServicio')
            <li><i class="fa fa-arrow-circle-right color" aria-hidden="true"></i> <a href="{{url('admin/clientes/asignarservicio')}}">Asignar servicio a cliente</a></li>
        @endcan

        @can('serviciosPorPagar')

            <li><i class="fa fa-usd color" aria-hidden="true"></i> <a href="{{url('admin/servicios/serviciosporpagar')}}">Servicios por pagar</a></li>
        @endcan

        @can('ActivarServicio')
            <li><i class="fa fa-gavel color" aria-hidden="true"></i> <a href="{{url('admin/clientes/gestionar_servicios')}}">Servicios de clientes</a></li>
        @endcan

        @can('ActivarServicio')
            <li><i class="fa fa-gavel color" aria-hidden="true"></i> <a href="{{url('admin/pagos')}}">Pagos</a></li>
        @endcan


    @can('asociarEmpleadoCliente')
    <li><i class="fa fa-gavel color" aria-hidden="true"></i> <a href="{{url('admin/administrador/clienteEmpleado')}}">Asignar Consultor a cliente</a></li>
    @endcan









    @can('pagosClientes')
    <li><i class="fa fa-file-text-o color" aria-hidden="true"></i> <a href="{{url('/clientes/pagos')}}">Planilla Cliente</a></li>
    @endcan


    @can('historialPagos')
    <li><i class="fa fa-bar-chart color" aria-hidden="true"></i> <a href="{{url('/clientes/pagos/ver_pagos')}}">Historial de pagos</a></li>
    @endcan

    @can('verClientesDeEmpleados')
    <li><i class="fa fa-eye color" aria-hidden="true"></i> <a href="">Ver Clientes de Consultores</a></li>
    @endcan

    @can('verPropiosClientes')
    <li><i class="fa fa-gavel color" aria-hidden="true"></i> <a href="{{url('admin/empleados/verClientes')}}">Ver mis clientes</a></li>
    @endcan


    {{--<li><a href="{{url('admin/empleados/historialConversaciones')}}">Historico conversaciones</a></li>--}}
</ul>




