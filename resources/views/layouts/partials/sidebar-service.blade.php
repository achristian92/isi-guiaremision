<div id="services" class="
                {{ isOpenRoute(2,'contracts') }} || {{ isOpenRoute(2,'services') }}  || {{ isOpenRoute(2,'projects') }}
    || {{ isOpenRoute(2,'serviceorders') }} || {{ isOpenRoute(2,'concepts') }}
    ">
    <ul>
        <li class="navigation-divider m-0 text-center">Gestión Servicios</li>
        <hr class="mt-0">
        <li class="navigation-divider m-0 text-light font-weight-bold">Servicios</li>
        <li class="m-0"><a href="{{ route('service.contracts.index') }}" class="{{ isActiveRoute(2,'contracts') }} ml-3 mb-0">Contratos</a></li>
        <li class="m-0"><a href="{{ route('service.projects.index') }}" class="{{ isActiveRoute(2,'projects') }} ml-3 mb-0">Proyectos</a></li>
        <li class="m-0"><a href="{{ route('service.services.index') }}" class="{{ isActiveRoute(2,'services') }} ml-3 mb-0">Servicios</a></li>
        <li class="m-0"><a href="{{ route('service.serviceorders.index') }}" class="{{ isActiveRoute(2,'serviceorders') }} ml-3 mb-0">Orden Servicio</a></li>
        <li class="navigation-divider m-0 text-light font-weight-bold">General</li>
        <li class="m-0"><a href="{{ route('service.concepts.index') }}" class="{{ isActiveRoute(2,'concepts') }} ml-3 mb-0">Concepto de Servicio</a></li>
    </ul>
</div>
